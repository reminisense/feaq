<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/18/2016
 * Time: 12:31 PM
 */
class FreeQueue{

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
        return json_encode(['success' => 1]);
    }

    /**
     * Serves the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function serveNumber($transaction_number){
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_completed' => time()]);
        return json_encode(['success' => 1]);
    }

    /**
     * Drops the given transaction number
     * @param $transaction_number
     * @return string
     */
    public function dropNumber($transaction_number){
        TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_removed' => time()]);
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

    public function getServingTime($business_id){

    }
}