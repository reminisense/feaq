<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/18/2016
 * Time: 12:31 PM
 */
class FreeQueue{

    private $freeBroadcast;
    public function __construct(){
        $this->freeBroadcast = new FreeBroadcast();
    }

    /**
     * Issue a number to the service
     * @param $data[service_id]
     * @param $data[priority_number]
     * @param $data[note]
     * @return string
     */
    public function issueNumber($data){
        if(ProcessQueue::queueNumberActive($data['service_id'], $data['priority_number'])){
            return json_encode(['error' => 'Priority number is still active.']);
        }
        else{
            //$business_id = Business::getBusinessIdByServiceId($data['service_id']);
            $number = ProcessQueue::issueNumber($data['service_id'], $data['priority_number'], null, 'free');
            if(isset($data['note'])){ $this->saveNote($number['transaction_number'], $data['note']); }
            $this->freeBroadcast->sendNotifications($number['transaction_number'], 'issue');
            //ProcessQueue::updateBusinessBroadcast($business_id);
            return json_encode(['success' => 1, 'number' => $number]);
        }
    }

    /**
     * get all numbers of tbe service
     * @param $service_id
     * @return string
     */
    public function getNumbers($business_id){
        return json_encode(['numbers' => $this->allNumbers($business_id)]);
    }

    /**
     * Calls the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function callNumber($transaction_number){
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_called' => time()]);
        $this->saveAnalytics($transaction_number, 1, time());
        $this->freeBroadcast->sendNotifications($transaction_number, 'call');
        return json_encode(['success' => 1]);
    }

    /**
     * Serves the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function serveNumber($transaction_number){
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_completed' => time()]);
        $this->saveAnalytics($transaction_number, 2, time());
        $this->freeBroadcast->sendNotifications($transaction_number, 'serve');
        return json_encode(['success' => 1]);
    }

    /**
     * Drops the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function dropNumber($transaction_number){
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_removed' => time()]);
        $this->saveAnalytics($transaction_number, 3, time());
        $this->freeBroadcast->sendNotifications($transaction_number, 'drop');
        return json_encode(['success' => 1]);
    }

    public function allNumbers($business_id){
        $service = Service::getFirstServiceOfBusiness($business_id);
        return ProcessQueue::allNumbers($service->service_id);
    }

    public function getIssuedNumbers($business_id){
        $all_numbers = $this->allNumbers($business_id);
        return $all_numbers->uncalled_numbers;
    }

    public function getCalledNumbers($business_id){
        $all_numbers = $this->allNumbers($business_id);
        return $all_numbers->called_numbers;
    }

    private function saveNote($transaction_number, $note){
        PriorityQueue::where('transaction_number', '=', $transaction_number)->update(['note' => $note]);
    }

    public function getServingTime($business_id){}

    private function saveAnalytics($transaction_number, $action, $time){
        $transaction = DB::table('priority_number')
            ->join('priority_queue', 'priority_queue.track_id', '=', 'priority_number.track_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->where('terminal_transaction.transaction_number', '=', $transaction_number)
            ->first();
        $terminal = Terminal::where('service_id', '=', $transaction->service_id)->first();
        Analytics::insertAnalyticsQueueNumber($action, $transaction_number, $transaction->service_id, $transaction->date, $time, $terminal->terminal_id, $transaction->queue_platform);
    }
}