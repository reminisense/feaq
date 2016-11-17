<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/17/2016
 * Time: 12:38 PM
 */

class FreeBusiness{
    /**
     * Gets details of business
     * @param $business_id
     * @return array
     */
    public function businessDetails($business_id){
        if(!Business::where('business_id', '=', $business_id)->exists()){
            return json_encode(['error' => 'Business does not exist.']);
        }else{
            $business = Business::join('branch', 'branch.business_id', '=', 'business.business_id')
                ->join('service', 'service.branch_id', '=', 'branch.branch_id')
                ->join('queue_settings', 'queue_settings.service_id', '=', 'service.service_id')
                ->where('business.business_id', '=', $business_id)
                ->select('business.*', 'queue_settings.service_id', 'queue_settings.number_start', 'queue_settings.number_limit')
                ->first();

            return json_encode([
                'business' => [
                    'business_id' => $business->business_id,
                    'service_id' => $business->service_id,

                    'name' => $business->name,
                    'address' => $business->local_address,
                    'category' => $business->industry,
                    'key' => $business->raw_code,
                    'time_close' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
                    'people_in_line' => Analytics::getBusinessRemainingCount($business->business_id),
                    'logo' => $business->logo,

                    'number_start' => $business->number_start,
                    'number_limit' => $business->number_limit,

                    'serving_time' => '',
                ]
            ]);
        }
    }

    /**
     * updates the business and the queue settings of all services of that business
     * @param $data[business_id]
     * @param $data[name]
     * @param $data[address]
     * @param $data[category]
     * @param $data[number_start]
     * @param $data[number_limit]
     * @param $data[time_close]
     * @return array|string
     */
    public function updateBusiness($data){
        if(!isset($data['business_id']) || $data['business_id'] == ''){
            return json_encode(['error' => 'Invalid Business ID.']);
        }

        $business_id = $data['business_id'];
        if(!Business::where('business_id', '=', $business_id)->exists()){
            return json_encode(['error' => 'Business does not exist.']);
        }else{
            //update business details
            try{
                $time_array = Helper::parseTime($data['time_close']);
                $business_data = [
                    'business.name' => $data['name'],
                    'business.local_address' => $data['address'],
                    'business.industry' => $data['category'],

                    'business.close_hour' => $time_array['hour'],
                    'business.close_minute' => $time_array['min'],
                    'business.close_ampm' => $time_array['ampm'],

                    'queue_settings.number_start' => $data['number_start'],
                    'queue_settings.number_limit' => $data['number_limit'],
                ];

                //Business::where('business_id', '=', $business_id)->update($business_data);

                Business::join('branch', 'branch.business_id', '=', 'business.business_id')
                    ->join('service', 'service.branch_id', '=', 'branch.branch_id')
                    ->join('queue_settings', 'queue_settings.service_id', '=', 'service.service_id')
                    ->where('business.business_id', '=', $business_id)
                    ->update($business_data);

                return $this->businessDetails($business_id);
            }catch (Exception $e){
                return json_encode(['error' => $e->getMessage()]);
            }

        }
    }

}