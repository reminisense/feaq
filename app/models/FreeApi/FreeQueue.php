<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/18/2016
 * Time: 12:31 PM
 */
class FreeQueue{

    public function issueNumber($data){
        if(ProcessQueue::queueNumberActive($data['service_id'], $data['priority_number'])){
            return json_encode(['error' => 'Priority number is still active.']);
        }
        else{
            //$business_id = Business::getBusinessIdByServiceId($data['service_id']);
            $number = ProcessQueue::issueNumber($data['service_id'], $data['priority_number']);
            //ProcessQueue::updateBusinessBroadcast($business_id);
            return json_encode(['success' => 1, 'number' => $number]);
        }
    }

    public function allNumbers($service_id){
        return json_encode(['numbers' => ProcessQueue::allNumbers($service_id)]);
    }

}