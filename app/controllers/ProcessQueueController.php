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
        return View::make('process-queue.process-queue')
            ->with('body', 'processq')
            ->with('terminal_id', $terminal_id)
            ->with('terminal_name', Terminal::name($terminal_id))
            ->with('service_id', Terminal::serviceId($terminal_id))
            ->with('service_name', Service::getServiceNameByTerminalId($terminal_id))
            ->with('business_id', Business::getBusinessIdByTerminalId($terminal_id))
            ->with('business_name', Business::getBusinessNameByTerminalId($terminal_id));
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
            if(is_null(QueueTransaction::find($transaction_number))){
                return json_encode(['error' => 'You have called an invalid input.']);
            }

            if(!TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)) {
                return json_encode(['error' => 'You are not assigned to this terminal.']);
            }

            $terminal_transaction = QueueTransaction::find($transaction_number);
            if($terminal_transaction->time_called != 0){
                return json_encode(['error' => 'Number ' . $terminal_transaction->priority_number . ' has already been called. Please call another number.']);
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

    public function getDropnumber($transaction_number){
        try{
            return ProcessQueue::processNumber($transaction_number, 'remove');
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

}