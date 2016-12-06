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

            $analytics = new Analytics();
            $time_estimates = $analytics->getServiceEstimateResults($business->service_id);

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

                    'serving_time' => round($time_estimates['upper_waiting_time'] / 60, 2) . ' min',
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

                Business::join('branch', 'branch.business_id', '=', 'business.business_id')
                    ->join('service', 'service.branch_id', '=', 'branch.branch_id')
                    ->join('queue_settings', 'queue_settings.service_id', '=', 'service.service_id')
                    ->where('business.business_id', '=', $business_id)
                    ->update($business_data);

                if(isset($data['logo']) && $data['logo'] != null){
                    $this->uploadBusinessLogo($data['logo'], $business_id);
                }

                return $this->businessDetails($business_id);
            }catch (Exception $e){
                return json_encode(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Insert business and user_business data
     * @param $user_id
     * @param $business_details
     * @return mixed
     */
    public function createBusiness($user_id, $business_details){
        //create business
        $business_id = Business::insertGetId($business_details);

        //create user business
        $user_business = [
            'user_id' => $user_id,
            'business_id' => $business_id,
        ];
        UserBusiness::insert($user_business);

        return $business_id;
    }

    public function uploadBusinessLogo($file, $business_id){
        $file_path = public_path() . '/logos/' . $business_id;
        $file->move($file_path, 'logo.png');
        Business::where('business_id', '=', $business_id)->update(['logo' => $file_path . '/logo.png']);
    }

    /**
     * Create branch, service, terminal
     * @param $business_id
     * @param $business_name
     * @param int $number_start
     * @param int $number_limit
     */
    public function createBusinessSetup($business_id, $business_name, $number_start = 1, $number_limit = 99){
        //insert branch details
        $branch_details = [
            'business_id' => $business_id,
            'name' => $business_name . ' Branch',
        ];
        $branch_id = Branch::insertGetId($branch_details);

        //insert service details
        $service_details = [
            'branch_id' => $branch_id,
            'name' => $business_name . ' Service',
        ];
        $service_id = Service::insertGetId($service_details);

        //insert terminal details
        $terminal_details = [
            'service_id' => $service_id,
            'name' => 'Counter 1',
        ];
        Terminal::insert($terminal_details);

        //inser queue settings
        $queue_settings = [
            'date' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
            'service_id' => $service_id,
            'number_start' => $number_start,
            'number_limit' => $number_limit,
        ];
        QueueSettings::insertGetId($queue_settings);
    }

}