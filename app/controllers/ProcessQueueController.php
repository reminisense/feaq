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
    public function getTerminal($terminal_id){
        if(!TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)){
            return Redirect::back();
        }

        $service_id = Terminal::serviceId($terminal_id);
        $process_queue_layout = QueueSettings::processQueueLayout($service_id);
        switch($process_queue_layout){
            case 1:
                $view = View::make('process-queue.process-queue-cards');
                break;
            default:
                $view = View::make('process-queue.process-queue');
                break;
        }

        return $view->with('body', 'processq')
            ->with('terminal_id', $terminal_id)
            ->with('terminal_name', Terminal::name($terminal_id))
            ->with('service_id', $service_id)
            ->with('service_name', Service::getServiceNameByTerminalId($terminal_id))
            ->with('business_id', Business::getBusinessIdByTerminalId($terminal_id))
            ->with('business_name', Business::getBusinessNameByTerminalId($terminal_id));
    }

    public function getForwardHistory($service_id){
        return View::make('process-queue.queue-history')
            ->with('body', 'processq')
            ->with('service_id', $service_id)
            ->with('service_name', Service::name($service_id))
            ->with('business_id', Business::getBusinessIdByServiceId($service_id))
            ->with('business_name', Business::getBusinessNameByServiceId($service_id))
            ->with('transactions', QueueForwardTransactions::getForwardTransactionsByServiceId($service_id));
    }

    /*==============================
            Ajax functions
    ================================*/

    /**
     * @param $transaction_number
     * @param null $terminal_id
     * @return string
     */
    public function getCallnumber($transaction_number, $terminal_id){
        try{
            if(is_null(TerminalTransaction::find($transaction_number))){
                return json_encode(['error' => 'You have called an invalid input.']);
            }

            if(!TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)) {
                return json_encode(['error' => 'You are not assigned to this terminal.']);
            }

            $terminal_transaction = TerminalTransaction::find($transaction_number);
            $priority_queue = PriorityQueue::find($transaction_number);
            if($terminal_transaction->time_called != 0){
                return json_encode(['error' => 'Number ' . $priority_queue->priority_number . ' has already been called. Please call another number.']);
            }else{
                return ProcessQueue::callTransactionNumber($transaction_number, Helper::userId(), $terminal_id);
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

    public function getDropnumber($transaction_number, $terminal_id = null){
        try{
            return ProcessQueue::processNumber($transaction_number, 'remove', $terminal_id);
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getAllnumbers($service_id, $terminal_id, $date = null){
        if(!TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)) {
            return json_encode(['error' => 'You are not assigned to this terminal.']);
        }

        if($date){
            $date_array = explode('-', $date);
            $date = mktime(0,0,0,$date_array[0],$date_array[1], $date_array[2]);
        }
        $numbers = ProcessQueue::allNumbers($service_id, $terminal_id, $date);
        return json_encode(['success' => 1, 'numbers' => $numbers], JSON_PRETTY_PRINT);
    }

    public function getUpdateBroadcast($business_id){
        $numbers = ProcessQueue::updateBusinessBroadcast($business_id);
        return json_encode(['success' => 1, 'numbers' => $numbers], JSON_PRETTY_PRINT);
    }

    public function getForwardHistoryData($service_id, $date){
        if($date){
            $date_array = explode('-', $date);
            $date = mktime(0,0,0,$date_array[0],$date_array[1], $date_array[2]);
        }
        return json_encode(['data' => QueueForwardTransactions::getForwardTransactionsByServiceId($service_id, $date)]);
    }

    public function getNextNumber($service_id){
        $all_numbers = ProcessQueue::allNumbers($service_id);
        return json_encode(['next_number' => $all_numbers->next_number]);
    }

    public function getCheckinTransaction($transaction_number){
        if(TerminalTransaction::where('transaction_number', '=', $transaction_number)->exists()){
            $time_checked_in = time();
            TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_checked_in' => $time_checked_in]);
            return json_encode([
                'success' => 1,
                'time_checked_in' => $time_checked_in,
                'transaction_number' => $transaction_number
            ]);
        }else{
            return json_encode(['success' => 0, 'error' => 'Transaction number not found.']);
        }
    }

    public function postStopQueue(){
        $numbers = Input::get('ids');
        $numbers = json_decode($numbers, true);
        TerminalTransaction::whereIn('transaction_number', $numbers)->update(['time_completed' => time()]);
        return json_encode(['success' => 1]);
    }
}