<?php
/**
 * Created by PhpStorm.
 * User: aunne
 * Date: 01/02/2016
 * Time: 11:35 AM
 */


class MobileController extends BaseController{

    //Screen #5
    public function getUserQueue($user_id)
    {
        $user = User::find($user_id);
        $transaction_number = PriorityQueue::getLatestTransactionNumberOfUser($user->user_id);
        $terminal_transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();

        if($terminal_transaction->time_completed > 0 || $terminal_transaction->time_removed > 0){

        }else{
            //user priority_number details
            $priority_queue = PriorityQueue::find($transaction_number);
            $priority_number = PriorityNumber::find($priority_queue->track_id);
            $queued_business_id = Business::getBusinessIdByServiceId($priority_number->service_id);
            $business = Business::find($queued_business_id);

            //business queueing status details
            $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);
            if(count($all_numbers->called_numbers) > 0){
                $last_called = json_decode(json_encode($all_numbers->called_numbers[0]));
                $last_called->service_id = Terminal::serviceId($last_called->terminal_id);
                $last_called->user_id = PriorityQueue::userId($last_called->transaction_number);
            }else{
                $last_called = new stdClass();
                $last_called->service_id = '';
                $last_called->user_id = '';
                $last_called->service_name = '';
                $last_called->terminal_id = '';
                $last_called->terminal_name = '';
                $last_called->priority_number = '';
                $last_called->name = '';
                $last_called->email = '';
                $last_called->phone = '';
            }

            $data = [
                'user_id' => $user->user_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'contact' => $user->phone,
                'priority_number' => $priority_queue->priority_number,
                'estimated_time_left' => Analytics::getServiceWaitingTime($priority_number->service_id),
                'business' => [
                    'id' => $business->business_id,
                    'name' => $business->name,
                    'address' => $business->local_address,
                    'image_url' => '',
                    'last_called' => [
                        'service_id' => $last_called->service_id,
                        'service_name' => $last_called->service_name,
                        'terminal_id' => $last_called->terminal_id,
                        'terminal_name' => $last_called->terminal_name,
                        'queue_number' => $last_called->priority_number,
                        'queue_user_id' => $last_called->user_id,
                        'queue_user_name' => $last_called->name,
                        'queue_user_email' => $last_called->email,
                        'queue_user_contact' => $last_called->phone,
                    ]
                ],
                'location' => [
                    'latitude' => $business->latitude,
                    'longitude' => $business->longitude,
                ],

            ];
        }
        return json_encode($data);
    }

    //Screen #10
    public function postSendMessage(){
        $user_id = Input::get('user_id');
        $business_id = Input::get('business_id');
        $message = Input::get('message');

        $email = User::email($user_id);
        $timestamp = time();
        $thread_key = Helper::threadKeyGenerator($business_id, $email);

        if (!Message::checkThreadByKey($thread_key)) {
            $phones[] = Input::get('contmobile');
            Message::createThread(array(
                'contactname' => User::first_name($user_id) . ' ' . User::last_name($user_id),
                'business_id' => $business_id,
                'email' => $email,
                'phone' => serialize($phones),
                'thread_key' => $thread_key,
            ));
            $data = json_encode(array(
                array(
                    'timestamp' => $timestamp,
                    'contmessage' => $message,
                    'sender' => 'user',
                )
            ));
            file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
        }
        else {
            $data = json_decode(file_get_contents(public_path() . '/json/messages/' . $thread_key . '.json'));
            $data[] = array(
                'timestamp' => $timestamp,
                'contmessage' => $message,
                'sender' => 'user',
            );
            $data = json_encode($data);
            file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
        }
        return json_encode(array('business_id' => $business_id, 'user_id' => $user_id, 'message' => $message));
    }

    //Screen #12
    public function getBusinessStatus($business_id)
    {
        $business = Business::where('business_id', '=', $business_id)->first();
        if(!$business){
            json_encode(['error' => 'Business not fouund.']);
        }else{
            $services = Service::getServicesByBusinessId($business->business_id);
            $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);
            $all_numbers = json_decode(json_encode($all_numbers));

            //get services list
            $service_list = array();
            foreach($services as $service){
                array_push($service_list, [
                    'id' => $service->service_id,
                    'name' => $service->name,
                    'isEnabled' => QueueSettings::allowRemote($service->service_id) ? true : false,
                ]);
            }
            $broadcast_numbers = array();
            if($all_numbers){
                $json_path = public_path() . '/json/' . $business->business_id . '.json';
                $json_contents = file_get_contents($json_path);
                $json = json_decode($json_contents);
                $max_count = explode("-", $json->display)[1];
                $box_count = 1;

                if(!isset($json->show_issued) || $json->show_issued){
                    $numbers =  (object) array_merge((array) $all_numbers->called_numbers, (array) $all_numbers->uncalled_numbers);
                }else{
                    $numbers = $all_numbers->called_numbers;
                }

                foreach($numbers as $number){
                    if($box_count <= $max_count){ $box_count++; }else{ break; }
                    $user = $number->email ? User::searchByEmail($number->email) : null;
                    $user = json_decode(json_encode($user));
                    array_push($broadcast_numbers, [
                        'service_id' => $number->service_id,
                        'service_name' => $number->service_name,
                        'terminal_id' => isset($number->terminal_id) ? $number->terminal_id : null,
                        'terminal_name' => isset($number->terminal_name) ? $number->terminal_name : null,
                        'priority_number' => $number->priority_number,
                        'user_id' => $user ? $user->user_id : null,
                        'user_first_name' => $user ? $user->first_name : $number->name
                    ]);
                }
            }

            $data = [
                'business_id' => $business->business_id,
                'business_name' => $business->name,
                'ticker_message' => 'This is a ticker message',
                'service_list' => $service_list,
                'broadcast_numbers' => $broadcast_numbers
            ];

            return json_encode($data);
        }
    }
}