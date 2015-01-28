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
        return View::make('process-queue.process-queue')
            ->with('service_id', $service_id)
            ->with('terminal_id', $terminal_id);
    }

    /*==============================
            Ajax functions
    ================================*/

    /**
     * @param $transaction_number
     * @param null $terminal_id
     * @return string
     */
    public function getCallnumber($transaction_number, $terminal_id = null){
        try{
            if(is_null(TerminalTransaction::find($transaction_number))){
                return json_encode(['error' => 'You have called an invalid input.']);
            }else if(Helper::currentUserIsEither([2]) && is_null(Terminal::find($terminal_id))){
                return json_encode(['error' => 'Please choose a valid terminal.']);
            }

            $terminal_transaction = TerminalTransaction::find($transaction_number);
            $priority_queue = PriorityQueue::find($transaction_number);
            if($terminal_transaction->time_called != 0){
                return json_encode(['error' => 'Number ' . $priority_queue->priority_number . ' has already been called. Please call another number.']);
            }else{
                ProcessQueue::callTransactionNumber($transaction_number, Helper::userId(), $terminal_id);
                return $this->getAllnumbers(PriorityNumber::serviceId($priority_queue->track_id));
            }
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getServenumber($transaction_number){
        try{
            return ProcessQueue::processNumber($transaction_number, 'serve');
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getDropnumber($transaction_number){
        try{
            return ProcessQueue::processNumber($transaction_number, 'remove');
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getIssuenumber($service_id, $priority_number = null, $date = null){
        $number = ProcessQueue::issueNumber($service_id, $priority_number, $date);
        return json_encode(['success' => 1, 'number' => $number]);
    }

    public function getIssuemultiple($service_id, $range, $date = null){
        for($i = 1; $i <= $range; $i++){
            $number = json_decode($this->getIssuenumber($service_id, null, $date));
            if($i == 1){
                $first = $number->priority_number . ' ' . $number->confirmation_code;
            }
        }
        $last = $number->priority_number . ' ' . $number->confirmation_code;
        return json_encode(['success' => 1, 'first_number' => $first, 'last_number' => $last,]);
    }

    public function getAllnumbers($service_id){
        $numbers = ProcessQueue::allNumbers($service_id);
        return json_encode(['success' => 1, 'numbers' => $numbers]);
    }

}