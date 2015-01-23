<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:57 PM
 */

class ProcessQueue extends Eloquent{

    public static function allNumbers($service_id){
        $numbers = []; //@todo add query to get all numbers
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
                    $uncalled_numbers[$number->transaction_number] = $number->priority_number;
                }else if($called && !$served && !$removed){
                    $called_numbers[$number->transaction_number] = array(
                        'transaction_number' => $number->transaction_number,
                        'priority_number' => $number->priority_number,
                        'confirmation_code' => $number->confirmation_code,
                        'terminal_id' => $number->terminal_id,
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

            usort($processed_numbers, array('PriorityQueue', 'sortProcessedNumbers'));
            $priority_numbers = new stdClass();
            $priority_numbers->called_numbers = $called_numbers;
            $priority_numbers->uncalled_numbers = $uncalled_numbers;
            $priority_numbers->processed_numbers = array_reverse($processed_numbers);

            return $priority_numbers;
        }else{
            return null;
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
        if(Helper::currentUserIsEither([4]) && (!TerminalManager::checkLoginIdIsUser(Helper::userId(), $login_id) || TerminalManager::hookedTerminal(Helper::userId()) != $terminal_id)){
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
            )
        ));
    }

    //calls a number based on its transaction number
    public static function callTransactionNumber($transaction_number, $user_id, $terminal_id = null){
        if(Helper::currentUserIsEither([1, 2, 6])){ //for business user and master admins
            if(is_numeric($terminal_id)){
                $login_id = TerminalManager::hookedTerminal(null, $terminal_id) ? TerminalManager::getLatestLoginIdOfTerminal($terminal_id) : 0;
                TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, null, $terminal_id);
            }else{
                throw new Exception('Please assign a terminal.');
            }
        }else if(Helper::currentUserIsEither([4])){ //for terminal admin
            $login_id = TerminalManager::getTerminalManagerLoginId($user_id);
            $terminal_id = TerminalManager::hookedTerminal($user_id);
            TerminalTransaction::updateTransactionTimeCalled($transaction_number, $login_id, null, $terminal_id);
        }else{
            throw new Exception('You are not allowed to call a number.');
        }
    }
}