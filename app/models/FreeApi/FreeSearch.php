<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 6:15 PM
 */

class FreeSearch {
    /**
     * gets businesses based on the search parameters given
     * @param $data
     * @param $data[longitude]
     * @param $data[latitude]
     * @param $data[category]
     * @param $data[key]
     * @return mixed
     */
    public function businessSearch($data){
        if(isset($data['latitude']) && !is_numeric($data['latitude'])){
            return json_encode(['error' => 'Latitude is not a number']);
        }

        if(isset($data['longitude']) && !is_numeric($data['longitude'])){
            return json_encode(['error' => 'Longitude is not a number']);
        }


        $query = Business::join('branch', 'branch.business_id', '=', 'business.business_id')
            ->join('service', 'service.branch_id', '=', 'branch.branch_id')
            ->where('business.status', '=', 1)
            ->where('business.free_account', '=', 1);

        //get the geolocation of the user and search businesses near that user
        if(isset($data['latitude']) && $data['latitude'] != '' && isset($data['longitude']) && $data['longitude'] != ''){
            $max_lat = $data['latitude'] + 0.06;
            $max_long = $data['longitude'] + 0.06;
            $min_lat = $data['latitude'] - 0.06;
            $min_long = $data['longitude'] - 0.06;

            $query->where('business.latitude', '>=', $min_lat)
                ->where('business.latitude', '<=', $max_lat)
                ->where('business.longitude', '>=', $min_long)
                ->where('business.longitude', '<=', $max_long);
        }

        //get the category given by the user and search businesses with that category
        if(isset($data['category']) && $data['category'] != '' && $data['category'] != 'All'){
//            $query->where('business.industry', '=', $data['category']);
                $query->whereIn('business.industry', $data['category']);
        }

        //get a keyword from the user and search the name, raw_code and address for that keyword
        if(isset($data['key'] )  && $data['key'] != ''){
            $query->where(function($query) use ($data){
                $query->where('business.raw_code', '=', $data['key'])
                    ->orWhere('business.name', 'LIKE', '%' . $data['key'] . '%')
                    ->orWhere('business.local_address', 'LIKE', '%' . $data['key'] . '%');
            });

        }

        //display all results
        $businesses = $query
            ->groupBy('business.business_id')
            ->select('business.*', 'branch.branch_id', 'service.service_id')
            ->get();
        return $this->organizeBusinessData($businesses);
    }

    private function organizeBusinessData($businesses){
        $business_data = array();
        foreach($businesses as $business){
//            $analytics = new Analytics();
//            $time_estimates = $analytics->getServiceEstimateResults($business->service_id);
            if (MeanServingTime::isServiceExisting($business->service_id)) {
                $final_mean = MeanServingTime::fetchMeans($business->service_id)->final_mean;
            }
            else {
                $final_mean = 0;
            }
            if (QueueStatus::isPunchTypeExists($business->service_id)) {
                $punch_type = QueueStatus::getLatestPunchTypeByServiceId($business->service_id);
            }
            else {
                $punch_type = 'Stop';
            }

            $business_data[] = [
                'business_id' => $business->business_id,
                'name' => $business->name,
                'address' => $business->local_address,
                'category' => $business->industry,
                'key' => $business->raw_code,
                'time_close' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
                'time_open' => Helper::mergeTime($business->open_hour, $business->open_minute, $business->open_ampm),
                'people_in_line' => Analytics::getBusinessRemainingCount($business->business_id),
//                'serving_time' => Helper::millisecondsToHMSFormat($time_estimates['upper_waiting_time']),
                'serving_time' => $final_mean,
                'punch_type' => $punch_type,
                'logo' => $business->logo,
            ];
        }

        return $business_data;
    }
}