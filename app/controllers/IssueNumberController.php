<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/28/15
 * Time: 1:53 PM
 */

class IssueNumberController extends BaseController{

    public function getMultiple($service_id, $range, $terminal_id = 0, $number_start = null, $date = null){
        if($terminal_id != 0 && !TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)){
            return json_encode(['error' => 'You are not assigned to this terminal.']);
        }

        $terminal_id = QueueSettings::terminalSpecificIssue($service_id) ? $terminal_id : 0;
        $next_number = ProcessQueue::nextNumber(ProcessQueue::lastNumberGiven($service_id), QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
        $queue_platform = $number_start == $next_number || $number_start == null ? 'web' : 'specific';
        $number_start = $number_start == null ? $next_number : $number_start;

        $result = ProcessQueue::issueMultiple($service_id, $number_start, $range, $date, $queue_platform, $terminal_id);
        $result['success'] = 1;
        return json_encode($result);
    }

    public function postInsertspecific($service_id, $terminal_id = 0, $queue_platform = 'web'){
        if($terminal_id != 0 && !TerminalUser::isCurrentUserAssignedToTerminal($terminal_id)){
            return json_encode(['error' => 'You are not assigned to this terminal.']);
        }

        $priority_number = Input::get('priority_number');
        $name = Input::get('name');
        $phone = Input::get('phone');
        $email = Input::get('email');
        $time_assigned = Input::get('time_assigned') ? strtotime(Input::get('time_assigned')) : 0;
        $terminal_id = QueueSettings::terminalSpecificIssue($service_id) ? $terminal_id : 0;
        $business_id = Business::getBusinessIdByServiceId($service_id);

        $next_number = ProcessQueue::nextNumber(ProcessQueue::lastNumberGiven($service_id), QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
        $queue_platform = $priority_number == $next_number || $priority_number == null ? $queue_platform : 'specific';

        if($email != ''){
            $thread_key = Helper::threadKeyGenerator($business_id, $email);
            if (!Message::checkThreadByKey($thread_key)) {
                Message::createThread(array(
                    'thread_key' => $thread_key,
                    'business_id' => $business_id,
                    'email' => $email,
                    'contactname' => $name ? $name : '',
                    'phone' => $phone ? $phone : ''
                ));
                $data = json_encode(array(
                    array(
                        'timestamp' => time(),
                        'contmessage' => 'Thank you for lining up!',
                        'attachment' => '',
                        'sender' => 'business',
                    )
                ));
                file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
            }
        }

        //save
        if(($queue_platform == 'android' || $queue_platform == 'remote') && !QueueSettings::checkRemoteQueue($service_id)){
            return json_encode(['error' => 'Remote queue option is not allowed at this time.']);
        }elseif(($queue_platform == 'android' || $queue_platform == 'remote') && $this->queueNumberExists($email)){
            return json_encode(['error' => 'You are only allowed to queue remotely once per day.']);
        }else{
            $number = ProcessQueue::issueNumber($service_id, $priority_number, null, $queue_platform, $terminal_id);
            PriorityQueue::updatePriorityQueueUser($number['transaction_number'], $name, $phone, $email);
            TerminalTransaction::where('transaction_number', '=', $number['transaction_number'])->update(['time_assigned' => $time_assigned]);
            return json_encode(['success' => 1, 'number' => $number]);
        }
    }

    private function queueNumberExists($email){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $count = PriorityNumber::where('priority_number.date', '=', $date)
            ->join('priority_queue', 'priority_queue.track_id', '=', 'priority_number.track_id')
            ->where('priority_queue.email', '=', $email)
            ->select(DB::raw('COUNT(priority_number.track_id) as number_exists'))
            ->first()
            ->number_exists;

        return $count > 0 ? TRUE : FALSE;
    }

    public function postIssueOther(){
        $queue_platform = 'web';
        $terminal_id = 0;

        $forwarder_id = Input::get('forwarder_id');
        $service_id = Input::get('service_id');
        $transaction_number = Input::get('transaction_number');
        $business_id = Business::getBusinessIdByServiceId($service_id);

        if(Business::getForwarderAllowedInBusiness($business_id, $forwarder_id)){
            $name = PriorityQueue::name($transaction_number);
            $phone = PriorityQueue::phone($transaction_number);
            $email = PriorityQueue::email($transaction_number);

            $next_number = ProcessQueue::nextNumber(ProcessQueue::lastNumberGiven($service_id), QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
            $priority_number = $next_number;

            $number = ProcessQueue::issueNumber($service_id, $priority_number, null, $queue_platform, $terminal_id);
            PriorityQueue::updatePriorityQueueUser($number['transaction_number'], $name, $phone, $email);
            $business_id = Business::getBusinessIdByServiceId($service_id);
            return json_encode(['success' => 1, 'number' => $number, 'business_id' => $business_id]);
        }{
            return json_encode(['error' => 'You are not allowed to issue a number to this business']);
        }
    }
}