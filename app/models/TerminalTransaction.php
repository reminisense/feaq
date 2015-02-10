<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:21 PM
 */

class TerminalTransaction extends Eloquent{

    protected $table = 'terminal_transaction';
    protected $primaryKey = 'transaction_number';
    public $timestamps = false;

    /*========================
     * retrieve methods
     =======================*/

    public static function terminalId($transaction_number){
        return TerminalTransaction::where('transaction_number', '=', $transaction_number)->first()->terminal_id;
    }


    /*===========================
     * update and create methods
     ============================*/

    /**
     * creates a new terminal transaction
     * @param unknown $transaction_number
     * @param string $time_queued
     */
    public static function createTerminalTransaction($transaction_number, $time_queued){
        $values = [
            'transaction_number' => $transaction_number,
            'time_queued' => $time_queued,
        ];
        TerminalTransaction::insert($values);
    }


    /**
     * updates the time called of a particular transaction
     * @param unknown $transaction_number
     * @param string $time_called
     */
    public static function updateTransactionTimeCalled($transaction_number, $login_id, $time_called = null, $terminal_id = null){
        $values['login_id'] = $login_id;
        $values['time_called'] = $time_called == null ? time() : $time_called;
        if(isset($terminal_id))$values['terminal_id'] =  $terminal_id;  //Adds terminal id to terminal transaction to bypass hooking of terminals
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    }

    /**
     * updates the time completed of a particular transaction
     * @param unknown $transaction_number
     * @param string $time_completed
     */
    public static function updateTransactionTimeCompleted($transaction_number, $time_completed = null){
        $values['time_completed'] = $time_completed == null ? time() : $time_completed;
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    }

    /**
     * updates the time removed of a particular transaction
     * @param unknown $transaction_number
     * @param string $time_removed
     */
    public static function updateTransactionTimeRemoved($transaction_number, $time_removed = null){
        $values['time_removed'] = $time_removed == null ? time() : $time_removed;
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update($values);
    }

    public static function getTransactionsNotYetCompleted() {
        return TerminalTransaction::where('time_completed', '=', 0)->select(array(DB::raw('COUNT(*) as nums')))->first()->nums;
    }

}