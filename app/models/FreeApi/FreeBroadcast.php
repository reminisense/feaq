<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/24/2016
 * Time: 3:39 PM
 */

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
}