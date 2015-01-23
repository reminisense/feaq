<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:57 PM
 */

class ProcessQueue extends Eloquent{

    public static function allNumbers($service_id){
        return array();
    }

    public static function processNumber($transaction_number, $process){
        return array();
    }

    //calls a number based on its transaction number
    public static function callTransactionNumber($transaction_number, $user_id, $terminal_id = null){
        if(Helper::currentUserIsEither([1, 2, 6])){ //for business user and master admins
            if(is_numeric($terminal_id)){
                $login_id = TerminalManager::hookedTerminal(null, $terminal_id) ? TerminalTransaction::getLatestLoginIdOfTerminal($terminal_id) : 0;
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