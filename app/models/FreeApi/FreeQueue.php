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
        if(!isset($data['service_id']) || $data['service_id'] == ''){
            return json_encode(['error' => 'Service ID is required.']);
        }

        if(!Service::where('service_id', '=', $data['service_id'])->exists()){
            return json_encode(['error' => 'Service does not exist.']);
        }

        if(!isset($data['priority_number']) || $data['priority_number'] == ''){
            return json_encode(['error' => 'Priority number is required.']);
        }

        if(ProcessQueue::queueNumberActive($data['service_id'], $data['priority_number'])){
            return json_encode(['error' => 'Priority number is still active.']);
        }

        $number = ProcessQueue::issueNumber($data['service_id'], $data['priority_number'], null, 'free');
        if(isset($data['note'])){ $this->saveNote($number['transaction_number'], $data['note']); }
        $this->freeBroadcast->sendNotifications($number['transaction_number'], 'issue');
        return json_encode(['success' => 1, 'number' => $number]);

    }

    /**
     * get all numbers of tbe service
     * @param $business_id
     * @return string
     */
    public function getNumbers($business_id){
        if(!Business::where('business_id', '=', $business_id)->exists()){
            return json_encode(['error' => 'Business does not exist.']);
        }
        return json_encode(['numbers' => $this->allNumbers($business_id)]);
    }

    /**
     * Calls the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function callNumber($transaction_number){
        if(!$this->checkTransactionExists($transaction_number)){
            return json_encode(['error' => 'Transaction does not exist.']);
        }

        if($this->checkTransactionCalled($transaction_number)){
            return json_encode(['error' => 'Transaction has recently been called.']);
        }

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
        if(!$this->checkTransactionExists($transaction_number)){
            return json_encode(['error' => 'Transaction does not exist.']);
        }

        if(!$this->checkTransactionCalled($transaction_number)){
            return json_encode(['error' => 'Transaction has not yet been called.']);
        }

        if($this->checkTransactionProcessed($transaction_number)){
            return json_encode(['error' => 'Transaction has recently been processed.']);
        }

        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_completed' => time()]);
        $this->saveAnalytics($transaction_number, 2, time());

        // update mean calculations every processed number
        $priority_queue = PriorityQueue::find($transaction_number);
        $priority_number = PriorityNumber::find($priority_queue->track_id);
        $meanServingTimes = Analytics::getServiceEstimatesFreeApp($priority_number->service_id);
        $this->storeMeanServingTimes($priority_number->service_id, $meanServingTimes);
        
        $this->freeBroadcast->sendNotifications($transaction_number, 'serve');
        return json_encode(['success' => 1]);
    }

    /**
     * Drops the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function dropNumber($transaction_number){
        if(!$this->checkTransactionExists($transaction_number)){
            return json_encode(['error' => 'Transaction does not exist.']);
        }

        if(!$this->checkTransactionCalled($transaction_number)){
            return json_encode(['error' => 'Transaction has not yet been called.']);
        }

        if($this->checkTransactionProcessed($transaction_number)){
            return json_encode(['error' => 'Transaction has recently been processed.']);
        }

        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_removed' => time()]);
        $this->saveAnalytics($transaction_number, 3, time());

        // update mean calculations every processed number
//        $priority_queue = PriorityQueue::find($transaction_number);
//        $priority_number = PriorityNumber::find($priority_queue->track_id);
//        $meanServingTimes = Analytics::getServiceEstimatesFreeApp($priority_number->service_id);
//        $this->storeMeanServingTimes($priority_number->service_id, $meanServingTimes);

        $this->freeBroadcast->sendNotifications($transaction_number, 'drop');
        return json_encode(['success' => 1]);
    }

    private function storeMeanServingTimes($service_id, $means) {
        $data = array(
          'mean_today' => $means["today"],
          'mean_yesterday' => $means["yesterday"],
          'mean_three_days' => $means["three_days"],
          'mean_this_week' => $means["this_week"],
          'mean_last_week' => $means["last_week"],
          'mean_this_month' => $means["this_month"],
          'mean_last_month' => $means["last_month"],
          'last_changed' => time(),
        );
        if (MeanServingTime::isServiceExisting($service_id)) {
            MeanServingTime::updateMeans($data, $service_id);
        }
        else {
            $data["service_id"] = $service_id;
            if ($means["today"] > 0) {
                $data["weight_today"] = 1;
            }
            if ($means["yesterday"] > 0) {
                $data["weight_yesterday"] = 1;
            }
            if ($means["three_days"] > 0) {
                $data["weight_three_days"] = 1;
            }
            if ($means["this_week"] > 0) {
                $data["weight_this_week"] = 1;
            }
            if ($means["last_week"] > 0) {
                $data["weight_last_week"] = 1;
            }
            if ($means["this_month"] > 0) {
                $data["weight_this_month"] = 1;
            }
            if ($means["last_month"] > 0) {
                $data["weight_last_month"] = 1;
            }
            MeanServingTime::saveMeans($data);
        }
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

    public function getServingTime($business_id){
        $service = Service::getFirstServiceOfBusiness($business_id);
//        $analytics = new Analytics();
//        $time_estimates = $analytics->getServiceEstimateResults($service->service_id);
        if (MeanServingTime::isServiceExisting($service->service_id)) {
            $final_mean = MeanServingTime::fetchMeans($service->service_id)->final_mean;
        }
        else {
            $final_mean = 0;
        }
//        return json_encode(['estimated_serving_time' => $time_estimates['estimated_serving_time']]);
        return json_encode([
          'estimated_serving_time' => $final_mean,
          'people_in_line' => Analytics::getBusinessRemainingCount($business_id),
        ]);
    }

    private function saveNote($transaction_number, $note){
        PriorityQueue::where('transaction_number', '=', $transaction_number)->update(['note' => $note]);
    }

    private function saveAnalytics($transaction_number, $action, $time){
        $transaction = DB::table('priority_number')
            ->join('priority_queue', 'priority_queue.track_id', '=', 'priority_number.track_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->where('terminal_transaction.transaction_number', '=', $transaction_number)
            ->first();
        $terminal = Terminal::where('service_id', '=', $transaction->service_id)->first();
        Analytics::insertAnalyticsQueueNumber($action, $transaction_number, $transaction->service_id, $transaction->date, $time, $terminal->terminal_id, $transaction->queue_platform);
    }

    private function checkTransactionExists($transaction_number){
        return TerminalTransaction::where('transaction_number', '=', $transaction_number)->exists();
    }

    private function checkTransactionCalled($transaction_number){
        $transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();
        if($transaction && $transaction->time_called > 0){
            return true;
        }
        return false;
    }

    private function checkTransactionProcessed($transaction_number){
        $transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();
        if($transaction && ($transaction->time_completed > 0 || $transaction->time_removed > 0)){
            return true;
        }
        return false;
    }
}