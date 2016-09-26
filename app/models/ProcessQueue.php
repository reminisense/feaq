<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:57 PM
 */

class ProcessQueue extends Eloquent{

    public static function issueNumber($service_id, $priority_number = null, $date = null, $queue_platform = 'web', $terminal_id = 0, $user_id = null, $confirmation_code = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;

        $service_properties = ProcessQueue::getServiceProperties($service_id, $date);

        $number_start = $service_properties->number_start;
        $number_limit = $service_properties->number_limit;
        $last_number_given = $service_properties->last_number_given;
        $current_number = $service_properties->current_number;
        $time_queued = time();

        if(!$priority_number){ $priority_number = $service_properties->next_number; }
        $priority_number = QueueSettings::numberPrefix($service_id) . $priority_number . QueueSettings::numberSuffix($service_id);

        $user_id = $user_id == null? Helper::userId() : $user_id;
        //$user_id = $queue_platform != 'web'? $user_id : 0;

        $track_id = PriorityNumber::createPriorityNumber($service_id, $number_start, $number_limit, $last_number_given, $current_number, $date);
        $confirmation_code = $confirmation_code == null?  strtoupper(substr(md5($track_id), 0, 4)) : $confirmation_code;
        $transaction_number = PriorityQueue::createPriorityQueue($track_id, $priority_number, $confirmation_code, $user_id, $queue_platform);
        TerminalTransaction::createTerminalTransaction($transaction_number, $time_queued, $terminal_id);
        Analytics::insertAnalyticsQueueNumberIssued($transaction_number, $service_id, $date, $time_queued, $terminal_id, $queue_platform); //insert to queue_analytics
        $number = array(
            'transaction_number' => $transaction_number,
            'priority_number' => $priority_number,
            'confirmation_code' => $confirmation_code,
        );

        return $number;
    }

    public static function issueMultiple($service_id, $first_number, $range, $date = null, $queue_platform = 'web', $terminal_id = 0, $user_id = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;

        $service_properties = ProcessQueue::getServiceProperties($service_id, $date);
        $number_start = $service_properties->number_start;
        $number_limit = $service_properties->number_limit;
        $last_number_given = $service_properties->last_number_given;
        $current_number = $service_properties->current_number;

        $time_queued = time();
        $user_id = $user_id == null? Helper::userId() : $user_id;
        $priority_number = $first_number;

        $priority_queue_data = array();
        $terminal_transaction_data = array();
        $analytics_data = array();
        //@todo insert bulk to priority number table and get track ids
        for($i = 1; $i <= $range; $i++){
            $track_id = PriorityNumber::createPriorityNumber($service_id, $number_start, $number_limit, $last_number_given, $current_number, $date);
            $confirmation_code = strtoupper(substr(md5($track_id), 0, 4));
            $transaction_number = PriorityQueue::createPriorityQueue($track_id, $priority_number, $confirmation_code, $user_id, $queue_platform);

            $terminal_transaction_data[] = array(
                'transaction_number' => $transaction_number,
                'time_queued' => $time_queued,
                'terminal_id' => $terminal_id
            );

            $analytics_data[] = array(
                'transaction_number' => $transaction_number,
                'date' => $date,
                'business_id' => Business::getBusinessIdByServiceId($service_id),
                'branch_id' => Service::branchId($service_id),
                'service_id' => $service_id,
                'terminal_id' => $terminal_id,
                'queue_platform' => $queue_platform,
                'user_id' => Helper::userId(),
                'action' => 0,
                'action_time' => $time_queued
            );

            $last_number_given = $priority_number;
            $priority_number++;
        }


        //@todo insert bulk to priority queue and get transaction numbers
        TerminalTransaction::insert($terminal_transaction_data); //insert bulk to terminal transaction
        Analytics::saveQueueAnalytics($analytics_data); //insert bulk to analytics
        return array('first_number' => $first_number, 'last_number' => $last_number_given);
    }

    //calls a number based on its transaction number
    public static function callTransactionNumber($transaction_number, $user_id, $terminal_id){
        if(is_numeric($terminal_id)){
            $pq = PriorityQueue::find($transaction_number);
            $pn = PriorityNumber::find($pq->track_id);
          $terminal_name = Terminal::name($terminal_id);
          $service_name = Service::name($pn->service_id);
            $time_called = time();
            $login_id = TerminalManager::hookedTerminal($terminal_id) ? TerminalManager::getLatestLoginIdOfTerminal($terminal_id) : 0;
            TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, $time_called, $terminal_id);
            Analytics::insertAnalyticsQueueNumberCalled($transaction_number, $pn->service_id, $pn->date, $time_called, $terminal_id, $pq->queue_platform); //insert to queue_analytics
            Notifier::sendNumberCalledNotification($transaction_number, $terminal_id); //notifies users that his/her number is called
          Notifier::sendPushNotification($transaction_number, $terminal_name, $service_name, 'call'); // PAG send push notifications
            return json_encode(['success' => 1, /*'numbers' => ProcessQueue::allNumbers(Terminal::serviceId($terminal_id))*/]); //ARA removed all numbers to prevent redundant database query
        }else{
            return json_encode(['error' => 'Please assign a terminal.']);
        }
    }

    /**
     * Common method used to serve or drop.
     * @param $transaction_number
     * @param $process
     * @param null $terminal_id
     * @param null $user_id
     * @return string
     * @throws Exception
     */
    public static function processNumber($transaction_number, $process, $terminal_id = null, $user_id = null)
    {
        $transaction = TerminalTransaction::find($transaction_number);
        $priority_queue = PriorityQueue::find($transaction_number);
        $priority_number = PriorityNumber::find($priority_queue->track_id);
        $pnumber = $priority_queue->priority_number;
        $confirmation_code = $priority_queue->confirmation_code;
        $terminal_id = $terminal_id != null ? $terminal_id : $transaction->terminal_id;

        if ($user_id == null) {
            $user_id = Helper::userId();
        }
        // check currently logged in user if no user was provided.
        // note: for webservice usage, this will be null.
        if (!TerminalUser::isUserAssignedToTerminal($user_id, $terminal_id)) {
            throw new Exception('You are not assigned to this terminal.');
        }

        try {
            $terminal = Terminal::findOrFail($terminal_id);
            $terminal_name = $terminal->name;
        } catch (Exception $e) {
            $terminal_name = '';
        }

        //ARA in case the number was not called but served/removed which is unlikely
        if ($transaction->time_called == 0 && $terminal_id != 0) {
            ProcessQueue::callTransactionNumber($transaction_number, $user_id, $terminal_id);
        }

        if ($transaction->time_removed == 0 && $transaction->time_completed == 0) {
            $time = time();
            if ($process == 'serve') {
                TerminalTransaction::updateTransactionTimeCompleted($transaction_number, $time);
                Analytics::insertAnalyticsQueueNumberServed($transaction_number, $priority_number->service_id, $priority_number->date, $time, $terminal_id, $priority_queue->queue_platform); //insert to queue_analytics
              Notifier::sendPushNotification($transaction_number, "", "", $process); // PAG send push notifications
            } else if ($process == 'remove') {
                TerminalTransaction::updateTransactionTimeRemoved($transaction_number, $time);
                Analytics::insertAnalyticsQueueNumberRemoved($transaction_number, $priority_number->service_id, $priority_number->date, $time, $terminal_id, $priority_queue->queue_platform); //insert to queue_analytics
              Notifier::sendPushNotification($transaction_number, "", "", $process); // PAG send push notifications
            }
        } else {
            return json_encode(array('error' => 'Number ' . $pnumber . ' has already been processed. If the number still exists, please reload the page.'));
        }

        return json_encode(array(
            'success' => 1,
            'priority_number' => array(
                'transaction_number' => $transaction_number,
                'priority_number' => $pnumber,
                'confirmation_code' => $confirmation_code,
                'terminal_id' => $terminal_id,
                'terminal_name' => $terminal_name,
            ),
            //'numbers' => ProcessQueue::allNumbers($priority_number->service_id), //ARA removed all numbers to prevent redundant database query
        ));
    }

    public static function allNumbers($service_id, $terminal_id = null, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        $numbers = ProcessQueue::queuedNumbers($service_id, $date);

        if($numbers){
            $priority_numbers = ProcessQueue::segregatedNumbers($numbers, $service_id, $terminal_id);
        }else{
            $priority_numbers = new stdClass();
            $priority_numbers->last_number_given = 0;
            $priority_numbers->number_prefix = QueueSettings::numberPrefix($service_id);
            $priority_numbers->number_suffix = QueueSettings::numberSuffix($service_id);
            $priority_numbers->next_number = QueueSettings::numberStart($service_id);
            $priority_numbers->current_number = 0;
            $priority_numbers->number_limit = QueueSettings::numberLimit($service_id);
            $priority_numbers->called_numbers = array();
            $priority_numbers->uncalled_numbers = array();
            $priority_numbers->processed_numbers = array();
            $priority_numbers->timebound_numbers = array();
            $priority_numbers->unprocessed_numbers = array();
        }

        return $priority_numbers;
    }

    public static function segregatedNumbers($numbers, $service_id, $terminal_id){
        $number_limit = QueueSettings::numberLimit($service_id);
        $terminal_specific_calling = QueueSettings::terminalSpecificIssue($service_id);
        $last_number_given = 0;
        $called_numbers = array();
        $uncalled_numbers = array();
        $processed_numbers = array();
        $unchecked_numbers = array();
        $timebound_numbers = array(); //ARA Timebound assignment
        $priority_numbers = new stdClass();
        $checkin_status = false; //JCA Added status for arrangment of unchecked numbers.

        foreach($numbers as $number){
            $called = $number->time_called != 0 ? TRUE : FALSE;
            $served = $number->time_completed != 0 ? TRUE : FALSE;
            $removed = $number->time_removed != 0 ? TRUE : FALSE;
            $records = FormRecord::getRecordIdFormIdByTransactionNumber($number->transaction_number);
            $form_records = [];

            $timebound = ($number->time_assigned) != 0 && ($number->time_assigned <= time()) ? TRUE : FALSE;
            $checked_in = isset($number->time_checked_in) && $number->time_checked_in != 0 ? TRUE : FALSE;

            try{
                $service_name = Service::name($service_id);
                if($number->terminal_id){
                    $terminal = Terminal::findOrFail($number->terminal_id);
                    $terminal_name = $terminal->name;
                }
            }catch(Exception $e){
                $service_name = '';
                $terminal_name = '';
            }

            if($number->queue_platform != 'specific'){
                $last_number_given = $number->priority_number;
            }

            if($number->email){
                $user = User::searchByEmail($number->email);
                if($user){
                    $verified = true;
                }else{
                    $verified = false;
                }

            }else{
                $verified = false;
            }


            foreach($records as $record){
                $form_data = FormRecord::getXMLPathByRecordId($record->record_id);
                $form_fields = unserialize(Forms::getFieldsByFormId($record->form_id));
                $content = simplexml_load_string(file_get_contents($form_data));
                $label = array_keys(get_object_vars($content->form_data));
                foreach($form_fields as $count=> $field){
                    $arr = (array) $content->form_data->{$label[$count]};
                    if($field['field_data']['label'] != $label[$count]){
                        $content->form_data->{$field['field_data']['label']} = empty($arr) ? "N/A" :$content->form_data->{$label[$count]};
                        unset($content->form_data->{$label[$count]});
                    }else{
                        $content->form_data->{$label[$count]} = empty($arr) ? "N/A" :$content->form_data->{$label[$count]};
                    }
                }
                $form_records[] = $content;
            }

            /*legend*/
            //uncalled  : not served and not removed
            //called    : called, not served and not removed
            //dropped   : called, not served but removed
            //removed   : not called but removed
            //served    : called and served
            //processed : dropped/removed/served
            //unchecked : not checked in and remote queued

            if(!$called && !$removed && $timebound){
                $timebound_numbers[] = array(
                    'transaction_number' => $number->transaction_number,
                    'queue_platform' => $number->queue_platform,
                    'priority_number' => $number->priority_number,
                    'service_id' => $service_id,
                    'service_name' => $service_name,
                    'name' => $number->name,
                    'phone' => $number->phone,
                    'email' => $number->email,
                    'form_records' => $form_records,
                    'verified_email' => $verified,
                    'checked_in' => $checked_in,
                    'time_called' => $number->time_called,
                    'confirmation_code' => $number->confirmation_code,
                );
            }else if(!$called && !$removed && $terminal_specific_calling && ($number->terminal_id == $terminal_id || $number->terminal_id == 0)){
                if($number->queue_platform == 'remote' && $checked_in == FALSE && $checkin_status == FALSE){
                    $unchecked_numbers[] = array(
                        'transaction_number' => $number->transaction_number,
                        'queue_platform' => $number->queue_platform,
                        'priority_number' => $number->priority_number,
                        'service_id' => $service_id,
                        'service_name' => $service_name,
                        'name' => $number->name,
                        'phone' => $number->phone,
                        'email' => $number->email,
                        'form_records' => $form_records,
                        'verified_email' => $verified,
                        'checked_in' => $checked_in,
                        'time_called' => $number->time_called,
                        'confirmation_code' => $number->confirmation_code,
                    );
                }else{
                    $uncalled_numbers[] = array(
                        'transaction_number' => $number->transaction_number,
                        'queue_platform' => $number->queue_platform,
                        'priority_number' => $number->priority_number,
                        'service_id' => $service_id,
                        'service_name' => $service_name,
                        'name' => $number->name,
                        'phone' => $number->phone,
                        'email' => $number->email,
                        'form_records' => $form_records,
                        'verified_email' => $verified,
                        'checked_in' => $checked_in,
                        'time_called' => $number->time_called,
                        'confirmation_code' => $number->confirmation_code,
                    );
                    $checkin_status = true;
                }
            }else if(!$called && !$removed && (!$terminal_specific_calling || $terminal_id == null)){
                if($number->queue_platform == 'remote' && $checked_in == FALSE && $checkin_status == FALSE){
                    $unchecked_numbers[] = array(
                        'transaction_number' => $number->transaction_number,
                        'queue_platform' => $number->queue_platform,
                        'priority_number' => $number->priority_number,
                        'service_id' => $service_id,
                        'service_name' => $service_name,
                        'name' => $number->name,
                        'phone' => $number->phone,
                        'email' => $number->email,
                        'form_records' => $form_records,
                        'verified_email' => $verified,
                        'checked_in' => $checked_in,
                        'time_called' => $number->time_called,
                        'confirmation_code' => $number->confirmation_code,
                    );
                }else{
                    $uncalled_numbers[] = array(
                        'transaction_number' => $number->transaction_number,
                        'queue_platform' => $number->queue_platform,
                        'priority_number' => $number->priority_number,
                        'service_id' => $service_id,
                        'service_name' => $service_name,
                        'name' => $number->name,
                        'phone' => $number->phone,
                        'email' => $number->email,
                        'form_records' => $form_records,
                        'verified_email' => $verified,
                        'checked_in' => $checked_in,
                        'time_called' => $number->time_called,
                        'confirmation_code' => $number->confirmation_code,
                    );
                    $checkin_status = true;
                }
            }else if($called && !$served && !$removed){
                $called_numbers[] = array(
                    'transaction_number' => $number->transaction_number,
                    'queue_platform' => $number->queue_platform,
                    'priority_number' => $number->priority_number,
                    'confirmation_code' => $number->confirmation_code,
                    'terminal_id' => $number->terminal_id,
                    'terminal_name' => $terminal_name,
                    'service_id' => $service_id,
                    'service_name' => $service_name,
                    'time_called' => $number->time_called,
                    'name' => $number->name,
                    'phone' => $number->phone,
                    'email' => $number->email,
                    'form_records' => $form_records,
                    'verified_email' => $verified, //Added by JCA
                    'box_rank' => Terminal::boxRank($number->terminal_id), // Added by PAG
                    'color' => Terminal::getColorByTerminalId($number->terminal_id),
                );
            }else if($called && !$served && $removed){
                $processed_numbers[] = array(
                    'transaction_number' => $number->transaction_number,
                    'queue_platform' => $number->queue_platform,
                    'priority_number' => $number->priority_number,
                    'confirmation_code' => $number->confirmation_code,
                    'terminal_id' => $number->terminal_id,
                    'terminal_name' => $terminal_name,
                    'service_id' => $service_id,
                    'service_name' => $service_name,
                    'time_processed' => $number->time_removed,
                    'status' => 'Dropped',
                    'time_called' => $number->time_called,
                );
            }else if(!$called && $removed){
                $processed_numbers[] = array(
                    'transaction_number' => $number->transaction_number,
                    'queue_platform' => $number->queue_platform,
                    'priority_number' => $number->priority_number,
                    'confirmation_code' => $number->confirmation_code,
                    'terminal_id' => $number->terminal_id,
                    'terminal_name' => $terminal_name,
                    'service_id' => $service_id,
                    'service_name' => $service_name,
                    'time_processed' => $number->time_removed,
                    'status' => 'Removed',
                    'time_called' => $number->time_called,
                );
            }else if($called && $served){
                $processed_numbers[] = array(
                    'transaction_number' => $number->transaction_number,
                    'queue_platform' => $number->queue_platform,
                    'priority_number' => $number->priority_number,
                    'confirmation_code' => $number->confirmation_code,
                    'terminal_id' => $number->terminal_id,
                    'terminal_name' => $terminal_name,
                    'service_id' => $service_id,
                    'service_name' => $service_name,
                    'time_processed' => $number->time_completed,
                    'status' => 'Served',
                    'time_called' => $number->time_called,
                    'confirmation_code' => $number->confirmation_code,
                );
            }
        }

        usort($processed_numbers, array('ProcessQueue', 'sortProcessedNumbers'));
        usort($called_numbers, array('ProcessQueue', 'sortCalledNumbers'));

        $priority_numbers->last_number_given = $last_number_given;
        $priority_numbers->number_prefix = QueueSettings::numberPrefix($service_id);
        $priority_numbers->number_suffix = QueueSettings::numberSuffix($service_id);
        $priority_numbers->number_start = QueueSettings::numberStart($service_id);
        $priority_numbers->number_limit = QueueSettings::numberLimit($service_id);
        $priority_numbers->next_number = ProcessQueue::nextNumber($priority_numbers->last_number_given, $priority_numbers->number_start, $priority_numbers->number_limit, $priority_numbers->number_prefix, $priority_numbers->number_suffix);
        $priority_numbers->current_number = $called_numbers ? $called_numbers[key($called_numbers)]['priority_number'] : 0;
        $priority_numbers->number_limit = $number_limit;
        $priority_numbers->called_numbers = $called_numbers;
        $priority_numbers->uncalled_numbers = array_merge($uncalled_numbers,$unchecked_numbers);
        $priority_numbers->processed_numbers = array_reverse($processed_numbers);
        $priority_numbers->timebound_numbers = $timebound_numbers;

        //
        $after_next = ProcessQueue::nextNumber($priority_numbers->number_prefix . $priority_numbers->next_number . $priority_numbers->number_suffix, $priority_numbers->number_start, $priority_numbers->number_limit, $priority_numbers->number_prefix, $priority_numbers->number_suffix);
        while(ProcessQueue::queueNumberActive($service_id, $priority_numbers->next_number, $after_next)){
            $priority_numbers->next_number = $after_next;
            $after_next = ProcessQueue::nextNumber($priority_numbers->number_prefix . $after_next . $priority_numbers->number_suffix, $priority_numbers->number_start, $priority_numbers->number_limit, $priority_numbers->number_prefix, $priority_numbers->number_suffix);
        }

        $priority_numbers->unprocessed_numbers = array_merge($priority_numbers->uncalled_numbers, $priority_numbers->called_numbers);
        usort($priority_numbers->unprocessed_numbers, array('ProcessQueue', 'sortUnprocessedNumbers'));
        $priority_numbers->unprocessed_numbers = array_merge($priority_numbers->timebound_numbers, $priority_numbers->unprocessed_numbers);

        return $priority_numbers;
    }

    public static function queuedNumbers($service_id, $date, $start = 0, $take = 2147483648){
        $query = DB::select('
			SELECT
				n.*,
				q.priority_number,
				q.confirmation_code,
				q.queue_platform,
				q.name,
			    q.phone,
			    q.email,
			    q.custom_fields,
				t.transaction_number,
				t.time_called,
				t.time_removed,
				t.time_completed,
				t.time_assigned,
			    t.time_checked_in,
			    t.terminal_id
			FROM
				`priority_number` n,
				`priority_queue` q,
				`terminal_transaction` t
			WHERE
				n.date = ? AND
				n.service_id = ? AND
				q.track_id = n.track_id AND
				t.transaction_number = q.transaction_number
			GROUP BY
				n.track_id,
				q.priority_number,
				q.confirmation_code,
				q.queue_platform,
				q.name,
			    q.phone,
			    q.email,
                q.custom_fields,
				t.transaction_number,
				t.time_called,
				t.time_removed,
				t.time_completed,
				t.time_assigned,
			    t.terminal_id
			LIMIT ?, ?
		', [$date, $service_id, $start, $take]);
        return !empty($query) ? $query : [];
    }

    public static function lastNumberGiven($service_id, $date = null, $default = 0){
        $numbers = ProcessQueue::allNumbers($service_id, null, $date);
        return $numbers ? $numbers->last_number_given : $default;
    }

    public static function currentNumber($service_id, $date = null, $default = 0){
        $numbers = ProcessQueue::allNumbers($service_id, null, $date);
        return $numbers ? $numbers->current_number : $default;
    }

    public static function nextNumber($last_number_given, $number_start, $number_limit, $prefix = '', $suffix = ''){
        if($prefix != '' || $suffix != ''){
            if($prefix != ''){
                $prefix_position = strpos($last_number_given, $prefix);
                if($prefix_position === 0){ $last_number_given = substr($last_number_given, strlen($prefix)); }
                elseif(is_numeric($last_number_given)){ $last_number_given = $number_limit; }
            }

            if($suffix != ''){
                $suffix_position = strpos($last_number_given, $suffix);
                if($suffix_position >= 1){ $last_number_given = substr($last_number_given, 0, (0 - strlen($suffix))); }
                elseif(is_numeric($last_number_given)){ $last_number_given = $number_limit; }
            }
        }

        return ($last_number_given < $number_limit && $last_number_given != 0) ? $last_number_given + 1 : $number_start;
    }

    public static function afterNextNumber(){

    }

    private static function sortProcessedNumbers($a, $b){
        return Helper::customSort('time_processed', $a, $b);
    }

    private static function sortCalledNumbers($a, $b){
        return Helper::customSortRev('time_called', $a, $b);
    }

    private static function sortUnprocessedNumbers($a, $b){
        return Helper::customSort('transaction_number', $a, $b);
    }

    public static function getServiceProperties($service_id, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        $numbers = ProcessQueue::allNumbers($service_id, null, $date);

        $properties = new stdClass();
        $properties->number_start = QueueSettings::numberStart($service_id, $date);
        $properties->number_limit = QueueSettings::numberLimit($service_id, $date);
        $properties->number_prefix = QueueSettings::numberPrefix($service_id, $date);
        $properties->number_suffix = QueueSettings::numberSuffix($service_id, $date);
        $properties->last_number_given = $numbers->last_number_given;
        $properties->current_number = $numbers->current_number;
        $properties->next_number = ProcessQueue::nextNumber($properties->last_number_given, $properties->number_start, $properties->number_limit, $properties->number_prefix, $properties->number_suffix);

        return $properties;
    }

    public static function updateBusinessBroadcast($business_id){
        $first_branch = Branch::where('business_id', '=', $business_id)->first();

        $services = Service::where('branch_id', '=', $first_branch->branch_id)->get();
        $all_numbers = null;
        $all_service_numbers = [];
        foreach($services as $service){
            $check_in_display = QueueSettings::checkInDisplay($service->service_id);
            $service_numbers = ProcessQueue::allNumbers($service->service_id);

            if($check_in_display){
                $service_numbers->check_in_numbers = array_slice($service_numbers->uncalled_numbers, 0, 5);
            }

            $all_service_numbers[$service->service_id] = clone $service_numbers; //because php passes objects by reference
            if($all_numbers){
                $all_numbers->called_numbers = array_merge($all_numbers->called_numbers, $service_numbers->called_numbers);
                $all_numbers->uncalled_numbers = array_merge($all_numbers->uncalled_numbers, $service_numbers->uncalled_numbers);
                $all_numbers->processed_numbers = array_merge($all_numbers->processed_numbers, $service_numbers->processed_numbers);
                $all_numbers->timebound_numbers = array_merge($all_numbers->timebound_numbers, $service_numbers->timebound_numbers);
                usort($all_numbers->called_numbers, array('ProcessQueue', 'sortCalledNumbers'));
            }else{
                $all_numbers = $service_numbers;
            }
        }

        ProcessQueue::saveAllNumbersToJson($business_id, $all_numbers);
        ProcessQueue::saveTerminalNumbersToJSON($business_id, $all_numbers);
        ProcessQueue::saveServiceNumbersToJSON($business_id, $all_service_numbers);

        //return $all_numbers;
    }

    public static function businessAllNumbers($business_id){
        $services = Service::getServicesByBusinessId($business_id);
        $all_numbers = [];
        foreach($services as $service){
            $service_numbers = ProcessQueue::allNumbers($service->service_id);
            if($all_numbers){
                $all_numbers->called_numbers = array_merge($all_numbers->called_numbers, $service_numbers->called_numbers);
                $all_numbers->uncalled_numbers = array_merge($all_numbers->uncalled_numbers, $service_numbers->uncalled_numbers);
                $all_numbers->processed_numbers = array_merge($all_numbers->processed_numbers, $service_numbers->processed_numbers);
                $all_numbers->timebound_numbers = array_merge($all_numbers->timebound_numbers, $service_numbers->timebound_numbers);

                usort($all_numbers->called_numbers, array('ProcessQueue', 'sortCalledNumbers'));
            }else{
                $all_numbers = $service_numbers;
            }

        }
        return $all_numbers;
    }

    public static function saveAllNumbersToJson($business_id, $all_numbers){
        if($all_numbers){
            $file_path = public_path() . '/json/' . $business_id . '.json';
            $json = file_get_contents($file_path);
            $boxes = json_decode($json);

            //ARA conditions to determine if only called numbers will be displayed on broadcast page
            if(!isset($boxes->show_issued) || $boxes->show_issued){
                $numbers =  array_merge($all_numbers->called_numbers, $all_numbers->uncalled_numbers);
            }else{
                $numbers = $all_numbers->called_numbers;
            }

            // $max_count = 6; //RDH via ARA : gisugo ko ni ruffy (dili ni tinuod) : set default value for $max_count

            // PAG Addition for Broadcast Display Settings
            $max_count = explode("-", $boxes->display)[1];

            $box_count = 1;
            $existing = array();
            for($counter = 1; $box_count <= $max_count; $counter++){
                if($counter <= count($numbers)){
                    $index = $counter - 1;
                    $number = isset($numbers[$index]['priority_number']) ? $numbers[$index]['priority_number'] : '';
                    if(!in_array($numbers[$index]['transaction_number'], $existing) || $number == ''){ //check if same number already exists
                        $existing[] = $numbers[$index]['transaction_number'];
                        $box = 'box'.$box_count;
                        $boxes->$box->number = $number;
                        $boxes->$box->service = isset($numbers[$index]['service_name']) ? $numbers[$index]['service_name'] : ''; //ARA Added service name for multiple services
                        $boxes->$box->terminal = isset($numbers[$index]['terminal_name']) ? $numbers[$index]['terminal_name'] : '';
                        $boxes->$box->rank = isset($numbers[$index]['box_rank']) ? $numbers[$index]['box_rank'] : ''; // Added by PAG
                        $boxes->$box->color = isset($numbers[$index]['color']) ? $numbers[$index]['color'] : ''; // Added by PAG
                        $boxes->$box->user = (isset($boxes->show_names) && $boxes->show_names) && isset($numbers[$index]['name']) ? $numbers[$index]['name'] : ''; //Added by ARA
                        $box_count++;
                    }
                }else{
                    $box = 'box'.$box_count;
                    $boxes->$box->number = '';
                    $boxes->$box->service = ''; //ARA Added service name for multiple services
                    $boxes->$box->terminal = '';
                    $boxes->$box->rank = ''; // Added by PAG
                    $boxes->$box->color = ''; // Added by PAG
                    $boxes->$box->user = ''; //Added by ARA
                    $box_count++;
                }
            }
            $boxes->get_num = $all_numbers->next_number;
            File::put($file_path, json_encode($boxes, JSON_PRETTY_PRINT));
        }
    }

    public static function saveServiceNumbersToJSON($business_id, $all_service_numbers){
        //ARA 08082016 - Added per service broadcast numbers
        if($all_service_numbers){
            $file_path = public_path() . '/json/' . $business_id . '.json';
            $json = file_get_contents($file_path);
            $boxes = json_decode($json);

            // PAG Addition for Broadcast Display Settings
            $max_count = explode("-", $boxes->display)[1];
            $boxes->services = new stdClass();
            foreach($all_service_numbers as $service_id => $service_numbers){
                $boxes->services->$service_id = new stdClass();
                $boxes->services->$service_id->queue_now = new stdClass();
                $check_in_display = QueueSettings::checkInDisplay($service_id);
                //ARA conditions to determine if only called numbers will be displayed on broadcast page
                if(!isset($boxes->show_issued) || $boxes->show_issued){
                    $numbers =  array_merge($service_numbers->called_numbers, $service_numbers->uncalled_numbers);
                }else{
                    $numbers = $service_numbers->called_numbers;
                }

                for($counter = 1; $counter <= $check_in_display; $counter++){
                    $index = $counter - 1;
                    $queue_now_box = 'queue_now' . $counter;
                    $uncalled_number = isset($service_numbers->uncalled_numbers[$index]) ? $service_numbers->uncalled_numbers[$index] : null;
                    $boxes->services->$service_id->queue_now->$queue_now_box = new stdClass();
                    $boxes->services->$service_id->queue_now->$queue_now_box->number = $uncalled_number ? $uncalled_number['priority_number'] : '';
                    $boxes->services->$service_id->queue_now->$queue_now_box->on_standby = $uncalled_number ? $uncalled_number['checked_in'] : '';
                    $boxes->services->$service_id->queue_now->$queue_now_box->rank = $uncalled_number ? $uncalled_number['service_id'] : '';
                    $boxes->services->$service_id->queue_now->$queue_now_box->service = $uncalled_number ? $uncalled_number['service_name'] : '';
                }

                $box_count = 1;
                $existing = array();
                for($counter = 1; $box_count <= $max_count; $counter++){
                    if($counter <= count($numbers)){
                        $index = $counter - 1;
                        $number = isset($numbers[$index]['priority_number']) ? $numbers[$index]['priority_number'] : '';
                        if(!in_array($numbers[$index]['transaction_number'], $existing) || $number == ''){ //check if same number already exists
                            $existing[] = $numbers[$index]['transaction_number'];
                            $box = 'box'.$box_count;
                            $boxes->services->$service_id->$box = new stdClass();
                            $boxes->services->$service_id->$box->number = $number;
                            $boxes->services->$service_id->$box->service = isset($numbers[$index]['service_name']) ? $numbers[$index]['service_name'] : ''; //ARA Added service name for multiple services
                            $boxes->services->$service_id->$box->terminal = isset($numbers[$index]['terminal_name']) ? $numbers[$index]['terminal_name'] : '';
                            $boxes->services->$service_id->$box->rank = isset($numbers[$index]['box_rank']) ? $numbers[$index]['box_rank'] : ''; // Added by PAG
                            $boxes->services->$service_id->$box->color = isset($numbers[$index]['color']) ? $numbers[$index]['color'] : ''; // Added by PAG
                            $boxes->services->$service_id->$box->user = (isset($boxes->show_names) && $boxes->show_names) && isset($numbers[$index]['name']) ? $numbers[$index]['name'] : ''; //Added by ARA
                            $box_count++;
                        }
                    }else{
                        $box = 'box'.$box_count;
                        $boxes->services->$service_id->$box = new stdClass();
                        $boxes->services->$service_id->$box->number = '';
                        $boxes->services->$service_id->$box->service = ''; //ARA Added service name for multiple services
                        $boxes->services->$service_id->$box->terminal = '';
                        $boxes->services->$service_id->$box->rank = ''; // Added by PAG
                        $boxes->services->$service_id->$box->color = ''; // Added by PAG
                        $boxes->services->$service_id->$box->user = ''; //Added by ARA
                        $box_count++;
                    }
                }
            }

            //$boxes->get_num = $all_numbers->next_number;
            File::put($file_path, json_encode($boxes, JSON_PRETTY_PRINT));
        }
    }

    public static function saveTerminalNumbersToJSON($business_id, $all_numbers){
        if($all_numbers){
            $file_path = public_path() . '/json/' . $business_id . '.json';
            $json = file_get_contents($file_path);
            $boxes = json_decode($json);

            $max_count = explode("-", $boxes->display)[1];
            $all_terminals = Terminal::getTerminalsByBusinessId($business_id);
            $numbers = $all_numbers->called_numbers;

            $boxes->terminals = new stdClass();
            foreach($all_terminals as $terminal){
                $boxes->terminals->$terminal['terminal_id'] = new stdClass();
                $boxes->terminals->$terminal['terminal_id']->box_count = 0;
            }

            foreach($numbers as $index => $number){
                if($boxes->terminals->$number['terminal_id']->box_count <= $max_count){
                    $boxes->terminals->$number['terminal_id']->box_count++;
                    $box = 'box' . $boxes->terminals->$number['terminal_id']->box_count;
                    if(!isset($boxes->terminals->$number['terminal_id']->$box)) $boxes->terminals->$number['terminal_id']->$box = new stdClass();
                    $boxes->terminals->$number['terminal_id']->$box->number = $numbers[$index]['priority_number'];
                    $boxes->terminals->$number['terminal_id']->$box->service = isset($numbers[$index]['service_name']) ? $numbers[$index]['service_name'] : ''; //ARA Added service name for multiple services
                    $boxes->terminals->$number['terminal_id']->$box->terminal = isset($numbers[$index]['terminal_name']) ? $numbers[$index]['terminal_name'] : '';
                    $boxes->terminals->$number['terminal_id']->$box->rank = isset($numbers[$index]['box_rank']) ? $numbers[$index]['box_rank'] : ''; // Added by PAG
                    $boxes->terminals->$number['terminal_id']->$box->color = isset($numbers[$index]['color']) ? $numbers[$index]['color'] : ''; // Added by PAG
                    $boxes->terminals->$number['terminal_id']->$box->user = (isset($boxes->show_names) && $boxes->show_names) && isset($numbers[$index]['name']) ? $numbers[$index]['name'] : ''; //Added by ARA
                }
            }
            File::put($file_path, json_encode($boxes, JSON_PRETTY_PRINT));
        }
    }

    public static function queueNumberActive($service_id, $priority_number, $next_number = null){
        if($priority_number == null){
            return ProcessQueue::queueNumberActive($service_id, $next_number);
        }

        $priority_number = QueueSettings::numberPrefix($service_id) . $priority_number . QueueSettings::numberSuffix($service_id);
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $count = PriorityNumber::where('priority_number.date', '=', $date)
            ->join('priority_queue', 'priority_queue.track_id', '=', 'priority_number.track_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->where('priority_number.service_id', '=', $service_id)
            ->where('priority_queue.priority_number', '=', $priority_number)
            ->where('terminal_transaction.time_completed', '=', 0)
            ->where('terminal_transaction.time_removed', '=', 0)
            ->select(DB::raw('COUNT(priority_number.track_id) as number_exists'))
            ->first()
            ->number_exists;

        return $count > 0 ? TRUE : FALSE;
    }
}