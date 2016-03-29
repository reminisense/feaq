<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/28/2016
 * Time: 1:10 PM
 */

class QueueForwardTransactions extends Eloquent{

    protected $table = 'queue_forward_transactions';
    protected $primaryKey = 'forward_id';
    public $timestamps = true;

    public static function createForwardTransaction($data){
        return QueueForwardTransactions::insertGetId($data);
    }

    public static function getForwardTransactionsByServiceId($service_id, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        return QueueForwardTransactions::join('user', 'user.user_id', '=', 'queue_forward_transactions.forwarder_user_id')
            ->join('terminal', 'terminal.terminal_id', '=', 'queue_forward_transactions.forwarder_terminal_id')
            ->join('service', 'service.service_id', '=', 'queue_forward_transactions.service_id')
            ->where('queue_forward_transactions.forwarder_service_id', '=', $service_id)
            ->where('queue_forward_transactions.date', '=', $date)
            ->select([
                'queue_forward_transactions.*',
                'user.first_name as forwarder_first_name',
                'user.last_name as forwarder_last_name',
                'terminal.name as forwarder_terminal_name',
                'service.name as forwarded_service',
            ])
            ->get();
    }

}