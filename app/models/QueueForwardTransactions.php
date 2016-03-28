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
        return QueueForwardTransactions::where('forwarder_service_id', '=', $service_id)->where('date', '=', $date)->get();
    }

}