<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 2:34 PM
 */

class ProcessQueueController extends BaseController{


    /**
     * Renders process queue page
     * @param $service_id
     */
    public function getMain($service_id, $terminal_id = null){
        return 'Hello';
    }

    public function getCallnumber($transaction_number, $terminal_id = null){
        try{
            if(is_null(TerminalTransaction::find($transaction_number))){
                return json_encode(array('error' => 'You have called an invalid input.'));
            }else if(Helper::currentUserIsEither([2]) && is_null(Terminal::find($terminal_id))){
                return json_encode(array('error' => 'Please choose a valid terminal.'));
            }

            $terminal_transaction = TerminalTransaction::find($transaction_number);
            $priority_queue = PriorityQueue::find($transaction_number);
            if($terminal_transaction->time_called != 0){
                return json_encode(array('error' => 'Number ' . $priority_queue->priority_number . ' has already been called. Please call another number.'));
            }else{
                PriorityQueue::callTransactionNumber($transaction_number, Auth::user()->user_id, $terminal_id);
            }
        }catch(Exception $e){
            return json_encode(array('error' => $e->getMessage()));
        }
    }

    public function getServenumber($transaction_number){
        try{
            return $this->processNumber($transaction_number, 'serve');
        }catch(Exception $e){
            return json_encode(array('error' => $e->getMessage()));
        }
    }

    public function getRemovenumber($transaction_number){
        try{
            return $this->processNumber($transaction_number, 'remove');
        }catch(Exception $e){
            return json_encode(array('error' => $e->getMessage()));
        }
    }

    public function getAllnumbers($service_id){
        $priority_numbers = $this->allNumbers($service_id);
        return json_encode(['success' => 1, 'priority_numbers' => $priority_numbers]);
    }

    private function processNumber($transaction_number, $process){

    }

    private function allNumbers($service_id){
        return Helper::allNumbers($service_id);
    }
}