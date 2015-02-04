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

        $number_start = QueueSettings::numberStart($service_id, $date);
        $number_limit = QueueSettings::numberLimit($service_id, $date);
        $last_number_given = ProcessQueue::lastNumberGiven($service_id, $date);
        $current_number = ProcessQueue::currentNumber($service_id, $date);

        if(!$priority_number){
            $priority_number = ($last_number_given < $number_limit && $last_number_given != 0) ? $last_number_given + 1 : $number_start;
        }
        $user_id = Helper::userId();

        $track_id = PriorityNumber::createPriorityNumber($service_id, $number_start, $number_limit, $last_number_given, $current_number, $date);
        $confirmation_code = strtoupper(substr(md5($track_id), 0, 4));
        $transaction_number = PriorityQueue::createPriorityQueue($track_id, $priority_number, $confirmation_code, $user_id, $queue_platform);
        TerminalTransaction::createTerminalTransaction($transaction_number, time());

        $number = array(
            'transaction_number' => $transaction_number,
            'priority_number' => $priority_number,
            'confirmation_code' => $confirmation_code,
        );

        return $number;
    }

    //calls a number based on its transaction number
    public static function callTransactionNumber($transaction_number, $user_id, $terminal_id = null){
        if(Helper::currentUserIsEither([1, 2, 6])){ //for business user and master admins
            if(is_numeric($terminal_id)){
                $login_id = TerminalManager::hookedTerminal($terminal_id) ? TerminalManager::getLatestLoginIdOfTerminal($terminal_id) : 0;
                TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, null, $terminal_id);
            }else{
                throw new Exception('Please assign a terminal.');
            }
        }else if(Helper::currentUserIsEither([4])){ //for terminal admin
            $login_id = TerminalManager::getTerminalManagerLoginId($user_id);
            $terminal_id = TerminalManager::getAssignedTerminal($user_id);
            TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, null, $terminal_id);
        }else{
            throw new Exception('You are not allowed to call a number.');
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

        $login_id = $transaction->login_id;
        if(Helper::currentUserIsEither([4]) && (!TerminalManager::checkLoginIdIsUser(Helper::userId(), $login_id) || TerminalManager::getAssignedTerminal(Helper::userId()) != $terminal_id)){
            return json_encode(array('error' => 'Access Denied'));
        }else if (Helper::currentUserIsEither([2, 6]) && UserBusiness::getBusinessIdByOwner(Helper::userId()) != Branch::businessId($priority_number->branch_id)) {
            return json_encode(array('error' => 'Access Denied'));
        }

        if($transaction->time_removed == 0 && $transaction->time_completed == 0){
            if($process == 'serve'){
                TerminalTransaction::updateTransactionTimeCompleted($transaction_number);
            }else if($process == 'remove'){
                TerminalTransaction::updateTransactionTimeRemoved($transaction_number);
            }
        }else{
            return json_encode(array('error' => 'Number ' . $pnumber . ' has already been processed. If the number still exists, please reload the page.'));
        }

//        if(PriorityQueue::getQueueSettingRepeatIssue($priority_number->service_id)){
//            $pc = new PriorityController();
//            $pc->getIssuenumber($priority_number->service_id, Service::branchId($priority_number->service_id), $pnumber);
//        }

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
        if($numbers){
            foreach($numbers as $number){
                $called = $number->time_called != 0 ? TRUE : FALSE;
                $served = $number->time_completed != 0 ? TRUE : FALSE;
                $removed = $number->time_removed != 0 ? TRUE : FALSE;

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

                if(!$called && !$removed){
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
            $priority_numbers->current_number = $called_numbers ? $called_numbers[key($called_numbers)]['priority_number'] : 0;
            $priority_numbers->called_numbers = $called_numbers;
            $priority_numbers->uncalled_numbers = $uncalled_numbers;
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

    private static function sortProcessedNumbers($a, $b){
        return $a['time_processed'] - $b['time_processed'];
    }
}