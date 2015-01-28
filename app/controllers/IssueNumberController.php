<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/28/15
 * Time: 1:53 PM
 */

class IssueNumberController extends BaseController{

    public function getSingle($service_id, $priority_number = null, $date = null){
        $number = ProcessQueue::issueNumber($service_id, $priority_number, $date);
        return json_encode(['success' => 1, 'number' => $number]);
    }

    public function getMultiple($service_id, $range, $date = null){
        for($i = 1; $i <= $range; $i++){
            $result = json_decode($this->getSingle($service_id, null, $date));
            if($i == 1){
                $first = $result->number->priority_number . ' ' . $result->number->confirmation_code;
            }
        }
        $last = $result->number->priority_number . ' ' . $result->number->confirmation_code;
        return json_encode(['success' => 1, 'first_number' => $first, 'last_number' => $last,]);
    }
}