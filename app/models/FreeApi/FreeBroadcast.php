<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/24/2016
 * Time: 3:39 PM
 */
use utils\ApplePushNotifications;

class FreeBroadcast {

    /**
     * gets data for business broadcast screen
     * @param $business_id
     * @return string
     */
    public function businessBroadcast($business_id){
        $broadcast_data = $this->getBroadcastData($business_id);
        return json_encode(['success' => 1, 'broadcast_data' => $broadcast_data]);
    }

    /**
     * gets data for customer app broadcast screen
     * @param $business_id
     * @return string
     */
    public function customerBroadcast($business_id){
        $business = Business::where('business_id', '=', $business_id)->first();
        $business_data = [
            'address' => $business->local_address,
            'time_close' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
            'people_in_line' => Analytics::getBusinessRemainingCount($business_id),
            'total_waiting_time' => '',
        ];
        $broadcast_data = $this->getBroadcastData($business_id);
        $broadcast_data = array_merge($business_data, $broadcast_data);
        return json_encode(['success' => 1, 'broadcast_data' => $broadcast_data]);
    }

    private function getBroadcastData($business_id){
        $first_service = Service::getFirstServiceOfBusiness($business_id);
        $all_numbers = ProcessQueue::allNumbers($first_service->service_id);

        $data = [
            'name' => Business::name($business_id),
            'called_numbers' => $all_numbers->called_numbers,
        ];

        return $data;
    }

    public function sendNotifications($transaction_number, $msg_type){
        $transaction = PriorityQueue::join('priority_number', 'priority_number.track_id', '=', 'priority_queue.track_id')
            ->join('service', 'service.service_id', '=', 'priority_number.service_id')
            ->join('branch', 'branch.branch_id', '=', 'service.branch_id')
            ->join('business', 'business.business_id', '=', 'branch.business_id')
            ->where('priority_queue.transaction_number', '=', $transaction_number)
            ->select('priority_queue.*', 'service.service_id', 'branch.branch_id', 'business.business_id')
            ->first();

        $business_logins = DB::table('business_login')
            ->where('business_id', '=', $transaction->business_id)
            ->groupBy('device_token')
            ->get();

        $message = '';
        if($msg_type == 'call'){
            $message = 'Number ' . $transaction->priority_number . ' has been called.';
        }elseif($msg_type == 'serve'){
            $message = 'Number ' . $transaction->priority_number . ' has been served.';
        }elseif($msg_type == 'drop'){
            $message = 'Number ' . $transaction->priority_number . ' has been dropped.';
        }

        foreach($business_logins as $login){
            $this->sendAppleNotification($login->device_token, $message, $msg_type);
        }
    }

    private function sendAppleNotification($device_token, $message, $msg_type){
        if(ctype_xdigit($device_token)){
            $APN = new \ApplePushNotifications($device_token, $message, null, $msg_type);
            $APN->sendNotif();
        }
    }
}