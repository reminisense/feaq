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
    public function getHome($service_id, $terminal_id = null){

    }

    public function getCallnumber($transaction_number, $terminal_id = null){

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