<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:21 PM
 */

class PriorityQueue extends Eloquent {

    protected $table = 'priority_queue';
    protected $primaryKey = 'transaction_number';
    public $timestamps = false;

    public static function email($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->email;
    }

    public static function phone($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->phone;
    }

    public static function priorityNumber($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->priority_number;
    }


    public static function createPriorityQueue($track_id, $priority_number, $confirmation_code, $user_id, $queue_platform){
        $values = [
            'priority_number' => $priority_number,
            'track_id' => $track_id,
            'confirmation_code' => $confirmation_code,
            'user_id' => $user_id,
            'queue_platform' => $queue_platform
        ];
        return PriorityQueue::insertGetId($values);
    }

    public static function updatePriorityQueueUser($transaction_number, $name = null, $phone = null, $email = null){
        $values = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ];
        PriorityQueue::where('transaction_number', '=', $transaction_number)->update($values);
    }

}