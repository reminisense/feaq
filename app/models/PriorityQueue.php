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

    public static function priorityNumber($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->priority_number;
    }

    public static function name($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->name;
    }

    public static function email($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->email;
    }

    public static function phone($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->phone;
    }

    public static function trackId($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->track_id;
    }

    public static function userId($transaction_number){
        return PriorityQueue::where('transaction_number', '=', $transaction_number)->first()->user_id;
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
        Helper::dbLogger('PriorityQueue', 'priority_queue', 'update', 'updatePriorityQueueUser', $email, 'transaction_number:' . $transaction_number);
    }

    public static function getTransactionNumberByTrackId($track_id) {
        return PriorityQueue::where('track_id', '=', $track_id)->select(array('transaction_number'))->get();
    }

    public static function getLatestTransactionNumberOfUser($user_id, $date = null){
        $date = $date != null ? $date : mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $terminal_transaction = PriorityQueue::join('priority_number', 'priority_number.track_id', '=', 'priority_queue.track_id')
            ->where('priority_number.date', '=', $date)
            ->where('priority_queue.user_id', '=', $user_id)
            ->orderBy('priority_queue.transaction_number', 'priority_queue.desc')
            ->first();
        return isset($terminal_transaction->transaction_number) ? $terminal_transaction->transaction_number : null;
    }

    public static function getTransactionHistory($transaction_number){
        $result = PriorityQueue::where('priority_queue.transaction_number','=',$transaction_number)
            ->join('queue_analytics', 'queue_analytics.transaction_number', '=', 'priority_queue.transaction_number')
            ->join('business', 'business.business_id', '=', 'queue_analytics.business_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->selectRaw('
                queue_analytics.transaction_number,
                queue_analytics.date as date,
                priority_queue.priority_number,
                priority_queue.email,
                business.business_id as business_id,
                business.name as business_name,
                business.local_address as business_address,
                business.longitude as longitude,
                business.latitude as latitude,
                terminal_transaction.time_completed as time_completed,
                terminal_transaction.time_queued as time_queued,
                terminal_transaction.time_queued as time_called,
                MAX(queue_analytics.action) as status
            ')
            ->first();

        return $result;
    }

}