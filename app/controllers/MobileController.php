<?php
/**
 * Created by PhpStorm.
 * User: aunne
 * Date: 01/02/2016
 * Time: 11:35 AM
 */


class MobileController extends BaseController{

    //Screen number 5
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
}