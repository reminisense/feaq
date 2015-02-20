<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:57 PM
 */

class ProcessQueue extends Eloquent{

    public static function issueNumber($service_id, $priority_number = null, $date = null, $queue_platform = 'web'){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;

        $service_properties = ProcessQueue::getServiceProperties($service_id, $date);

        $number_start = $service_properties->number_start;
        $number_limit = $service_properties->number_limit;
        $last_number_given = $service_properties->last_number_given;
        $current_number = $service_properties->current_number;
        $time_queued = time();

        if(!$priority_number){
            $priority_number = $service_properties->next_number;
        }
        $user_id = Helper::userId();

        $track_id = PriorityNumber::createPriorityNumber($service_id, $number_start, $number_limit, $last_number_given, $current_number, $date);
        $confirmation_code = strtoupper(substr(md5($track_id), 0, 4));
        $transaction_number = PriorityQueue::createPriorityQueue($track_id, $priority_number, $confirmation_code, $user_id, $queue_platform);
        TerminalTransaction::createTerminalTransaction($transaction_number, $time_queued);
        Analytics::insertAnalyticsQueueNumberIssued($transaction_number, $service_id, $date, $time_queued); //insert to queue_analytics
        $number = array(
            'transaction_number' => $transaction_number,
            'priority_number' => $priority_number,
            'confirmation_code' => $confirmation_code,
        );

        return $number;
    }

    //calls a number based on its transaction number
    public static function callTransactionNumber($transaction_number, $user_id, $terminal_id){
        if(is_numeric($terminal_id)){
            $pq = PriorityQueue::find($transaction_number)->first();
            $pn = PriorityNumber::find($pq->track_id)->first();
            $time_called = time();
            $login_id = TerminalManager::hookedTerminal($terminal_id) ? TerminalManager::getLatestLoginIdOfTerminal($terminal_id) : 0;
            TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, $time_called, $terminal_id);
            Analytics::insertAnalyticsQueueNumberCalled($transaction_number, $pn->service_id, $pn->date, $time_called, $terminal_id); //insert to queue_analytics
            Notifier::sendNumberCalledToAllChannels($transaction_number); //notifies users that his/her number is called
            return json_encode(['success' => 1, 'numbers' => ProcessQueue::allNumbers(Terminal::serviceId($terminal_id))]);
        }else{
            return json_encode(['error' => 'Please assign a terminal.']);
        }
    }

    public static function processNumber($transaction_number, $process){
        $transaction = TerminalTransaction::find($transaction_number);
        $priority_queue = PriorityQueue::find($transaction_number);
        $priority_number = PriorityNumber::find($priority_queue->track_id);
        $pnumber = $priority_queue->priority_number;
        $confirmation_code = $priority_queue->confirmation_code;
        $terminal_id = $transaction->terminal_id;
        try{
            $terminal = Terminal::findOrFail($transaction->terminal_id);
            $terminal_name = $terminal->name;
        }catch(Exception $e){
            $terminal_name = '';
        }

        if($transaction->time_removed == 0 && $transaction->time_completed == 0){
            $time = time();
            if($process == 'serve'){
                TerminalTransaction::updateTransactionTimeCompleted($transaction_number, $time);
                Analytics::insertAnalyticsQueueNumberServed($transaction_number, $priority_number->service_id, $priority_number->date, $time, $terminal_id); //insert to queue_analytics
            }else if($process == 'remove'){
                TerminalTransaction::updateTransactionTimeRemoved($transaction_number, $time);
                Analytics::insertAnalyticsQueueNumberRemoved($transaction_number, $priority_number->service_id, $priority_number->date, $time, $terminal_id); //insert to queue_analytics
            }
        }else{
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
            'numbers' => ProcessQueue::allNumbers($priority_number->service_id),
        ));
    }

    public static function allNumbers($service_id, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        $numbers = ProcessQueue::queuedNumbers($service_id, $date);
        $called_numbers = array();
        $uncalled_numbers = array();
        $processed_numbers = array();
        $timebound_numbers = array(); //ARA Timebound assignment
        if($numbers){
            foreach($numbers as $number){
                $called = $number->time_called != 0 ? TRUE : FALSE;
                $served = $number->time_completed != 0 ? TRUE : FALSE;
                $removed = $number->time_removed != 0 ? TRUE : FALSE;

                $timebound = ($number->time_assigned) != 0 && ($number->time_assigned <= time()) ? TRUE : FALSE;

                /*legend*/
                //uncalled  : not served and not removed
                //called    : called, not served and not removed
                //dropped   : called, not served but removed
                //removed   : not called but removed
                //served    : called and served
                //processed : dropped/removed/served

                $terminal_name = '';
                if($number->terminal_id){
                    try{
                        $terminal = Terminal::findOrFail($number->terminal_id);
                        $terminal_name = $terminal->name;
                    }catch(Exception $e){
                        $terminal_name = '';
                    }
                }

                if(!$called && !$removed && $timebound){
                    $timebound_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                    );
                }else if(!$called && !$removed){
                    $uncalled_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                    );
                }else if($called && !$served && !$removed){
                    $called_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                        'confirmation_code' => $number->confirmation_code,
                        'terminal_id' => $number->terminal_id,
                        'terminal_name' => $terminal_name,
                        'box_rank' => Terminal::boxRank($number->terminal_id) // Added by PAG
                    );
                }else if($called && !$served && $removed){
                    $processed_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                        'confirmation_code' => $number->confirmation_code,
                        'terminal_id' => $number->terminal_id,
                        'terminal_name' => $terminal_name,
                        'time_processed' => $number->time_removed,
                        'status' => 'Dropped',
                    );
                }else if(!$called && $removed){
                    $processed_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                        'confirmation_code' => $number->confirmation_code,
                        'terminal_id' => $number->terminal_id,
                        'terminal_name' => $terminal_name,
                        'time_processed' => $number->time_removed,
                        'status' => 'Removed',
                    );
                }else if($called && $served){
                    $processed_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                        'confirmation_code' => $number->confirmation_code,
                        'terminal_id' => $number->terminal_id,
                        'terminal_name' => $terminal_name,
                        'time_processed' => $number->time_completed,
                        'status' => 'Served',
                    );
                }
            }

            usort($processed_numbers, array('ProcessQueue', 'sortProcessedNumbers'));
            $priority_numbers = new stdClass();
            $priority_numbers->last_number_given = $numbers[count($numbers) - 1]->priority_number;
            $priority_numbers->next_number = ProcessQueue::nextNumber($priority_numbers->last_number_given, QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
            $priority_numbers->current_number = $called_numbers ? $called_numbers[key($called_numbers)]['priority_number'] : 0;
            $priority_numbers->called_numbers = $called_numbers;
            $priority_numbers->uncalled_numbers = array_merge($timebound_numbers, $uncalled_numbers);
            $priority_numbers->processed_numbers = array_reverse($processed_numbers);

            return $priority_numbers;
        }else{
            return null;
        }
    }

    public static function queuedNumbers($service_id, $date, $start = 0, $take = 2147483648){
        $query = DB::select('
			SELECT
				n.*,
				q.priority_number,
				q.confirmation_code,
				q.queue_platform,
				t.transaction_number,
				t.time_called,
				t.time_removed,
				t.time_completed,
				t.time_assigned,
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
				n.track_id
			LIMIT ?, ?
		', [$date, $service_id, $start, $take]);
        return !empty($query) ? $query : [];
    }

    public static function lastNumberGiven($service_id, $date = null, $default = 0){
        $numbers = ProcessQueue::allNumbers($service_id, $date);
        return $numbers ? $numbers->last_number_given : $default;
    }

    public static function currentNumber($service_id, $date = null, $default = 0){
        $numbers = ProcessQueue::allNumbers($service_id, $date);
        return $numbers ? $numbers->current_number : $default;
    }

    public static function nextNumber($last_number_given, $number_start, $number_limit){
        return ($last_number_given < $number_limit && $last_number_given != 0) ? $last_number_given + 1 : $number_start;
    }

    private static function sortProcessedNumbers($a, $b){
        return $a['time_processed'] - $b['time_processed'];
    }

    public static function getServiceProperties($service_id, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        $properties = new stdClass();
        $properties->number_start = QueueSettings::numberStart($service_id, $date);
        $properties->number_limit = QueueSettings::numberLimit($service_id, $date);
        $properties->last_number_given = ProcessQueue::lastNumberGiven($service_id, $date);
        $properties->current_number = ProcessQueue::currentNumber($service_id, $date);
        $properties->next_number = ProcessQueue::nextNumber($properties->last_number_given, $properties->number_start, $properties->number_limit);

        return $properties;
    }

    public static function updateBusinessBroadcast($business_id){
        $first_branch = Branch::where('business_id', '=', $business_id)->first();
        $first_service = Service::where('branch_id', '=', $first_branch->branch_id)->first();

        $all_numbers = ProcessQueue::allNumbers($first_service->service_id);
        if($all_numbers){
            $numbers = array_merge($all_numbers->called_numbers, $all_numbers->uncalled_numbers);

            $file_path = public_path() . '/json/' . $business_id . '.json';
            $json = file_get_contents($file_path);
            $boxes = json_decode($json);

            for($counter = 1; $counter <= 6; $counter++){
                $index = $counter - 1;
                $box = 'box'.$counter;
                $boxes->$box->number = isset($numbers[$index]['priority_number']) ? $numbers[$index]['priority_number'] : '';
                $boxes->$box->terminal = isset($numbers[$index]['terminal_name']) ? $numbers[$index]['terminal_name'] : '';
                $boxes->$box->rank = isset($numbers[$index]['box_rank']) ? $numbers[$index]['box_rank'] : ''; // Added by PAG
            }
            $boxes->get_num = $all_numbers->next_number;

            File::put($file_path, json_encode($boxes));
        }
    }
}