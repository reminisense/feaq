<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/17/2016
 * Time: 12:38 PM
 */

class FreeBusiness{
    public function businessCategories(){
        $categories = [
            ["name" => "All", "image" => ""],
            ["name" => "Agriculture", "image" => "http://i.imgur.com/xSyk3bU.jpg"],
            ["name" => "Energy", "image" => "http://i.imgur.com/3oZ7ylw.jpg"],
            ["name" => "Mining and Quarrying", "image" => "http://i.imgur.com/9hTs5NI.jpg"],
            ["name" => "Manufacturing", "image" => "http://i.imgur.com/1HE9m2i.jpg"],
            ["name" => "Government", "image" => "http://i.imgur.com/MfUDbhM.png"],
            ["name" => "Construction", "image" => "http://i.imgur.com/WqvbstH.jpg"],
            ["name" => "Wholesale and Retail", "image" => "http://i.imgur.com/0ikoTVW.jpg"],
            ["name" => "Hotels and Restaurants", "image" => "http://i.imgur.com/nTAyp2x.jpg"],
            ["name" => "Transportation", "image" => "http://i.imgur.com/4XX339B.jpg"],
            ["name" => "Telecommunications", "image" => "http://i.imgur.com/rMExRv9.jpg"],
            ["name" => "Financial", "image" => "http://i.imgur.com/dh3tEsN.png"],
            ["name" => "Education", "image" => "http://i.imgur.com/PcDmVM3.jpg"],
            ["name" => "Social Services", "image" => "http://i.imgur.com/dE5tbfr.jpg"],
            ["name" => "Health Care", "image" => "http://i.imgur.com/eSwQlvj.png"],
            ["name" => "Technology", "image" => "http://i.imgur.com/Hwaf0f9.jpg"],
            ["name" => "Entertainment", "image" => "http://i.imgur.com/5iK1lyh.jpg"],
            ["name" => "Mass Media", "image" => "http://i.imgur.com/jXUlyGG.jpg"],
        ];

        return json_encode($categories);
    }

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

                    'serving_time' => Helper::millisecondsToHMSFormat($time_estimates['upper_waiting_time']),
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
        $data = $this->checkBusinessErrors($data);
        if(isset($data['error'])){
            return json_encode($data);
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
                    'business.logo' => $data['logo'],

                    'business.latitude' => $data['latitude'],
                    'business.longitude' => $data['longitude'],

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

//                if(isset($data['logo']) && $data['logo'] != null){
//                    $this->uploadBusinessLogo($data['logo'], $business_id);
//                }

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

    private function checkBusinessErrors($data){
        if(!isset($data['business_id']) || $data['business_id'] == ''){
            return ['error' => 'Invalid Business id.'];
        }

        if(!isset($data['name'])){
            return ['error' => 'Business name is missing.'];
        }

        if(!isset($data['address'])){
            return ['error' => 'Address is missing.'];
        }

        if(!isset($data['category'])){
            return ['error' => 'Category is missing.'];
        }

        if(!isset($data['time_close'])){
            return ['error' => 'Time close is missing'];
        }

        if(!preg_match('/^([1-9]|1[0-2]|0[1-9]){1}(:[0-5][0-9] [aApP][mM]){1}$/', $data['time_close'])){
            return ['error' => 'Invalid time format.'];
        }

        if(!isset($data['number_start'])){
            return ['error' => 'Number start is missing.'];
        }

        if(!is_numeric($data['number_start'])){
            return ['error' => 'Invalid number.'];
        }

        if(!isset($data['number_limit'])){
            return ['error' => 'Number limit is missing.'];
        }

        if(!is_numeric($data['number_limit'])){
            return ['error' => 'Invalid number.'];
        }

        if(!isset($data['logo'])){
            $data['logo'] = '';
        }

        if(isset($data['latitude']) && !is_numeric($data['latitude'])){
            return ['error' => 'Incorrect latitude value.'];
        }

        if(isset($data['longitude']) && !is_numeric($data['longitude'])){
            return ['error' => 'Incorrect longitude value.'];
        }

        return $data;
    }

}