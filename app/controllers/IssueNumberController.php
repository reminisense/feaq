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
            $number = ProcessQueue::issueNumber($service_id, null, $date);
            if($i == 1){
                $first = $number['priority_number'];
            }
        }
        $last = $number['priority_number'];
        return json_encode(['success' => 1, 'first_number' => $first, 'last_number' => $last,]);
    }

    public function postInsertspecific($service_id){
        $priority_number = Input::get('priority_number');
        $name = Input::get('name');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $time_assigned = Input::get('time_assigned') ? strtotime(Input::get('time_assigned')) : 0;

        $next_number = ProcessQueue::nextNumber(ProcessQueue::lastNumberGiven($service_id), QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
        $queue_platform = $priority_number == $next_number || $priority_number == null ? 'web' : 'specific';

        //save
        $number = ProcessQueue::issueNumber($service_id, $priority_number, null, $queue_platform);
        PriorityQueue::updatePriorityQueueUser($number['transaction_number'], $name, $phone, $email);
        TerminalTransaction::where('transaction_number', '=', $number['transaction_number'])->update(['time_assigned' => $time_assigned]);
        return json_encode(['success' => 1, 'number' => $number]);
    }
}