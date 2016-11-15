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
        //@todo do some error checking here


        $query = Business::where('status', '=', 1);
        //get the geolocation of the user and search businesses near that user
        if(isset($data['latitude']) && isset($data['longitude'])){
            $max_lat = $data['latitude'] + 0.06;
            $max_long = $data['longitude'] + 0.06;
            $min_lat = $data['latitude'] - 0.06;
            $min_long = $data['longitude'] - 0.06;

            $query->where('latitude', '>=', $min_lat)
                ->where('latitude', '<=', $max_lat)
                ->where('longitude', '>=', $min_long)
                ->where('longitude', '<=', $max_long);
        }

        //get the category given by the user and search businesses with that category
        if(isset($data['category'])){
            $query->where('industry', '=', $data['category']);
        }

        //get a keyword from the user and search the name, raw_code and address for that keyword
        if(isset($data['key'])){
            $query->orWhere('raw_code', '=', $data['key'])
                ->orWhere('name', 'LIKE', $data['key'])
                ->orWhere('local_address', 'LIKE', $data['key']);
        }

        //display all results
        return $this->organizeBusinessData($query->get());
    }

    private function organizeBusinessData($businesses){
        $business_data = array();
        foreach($businesses as $business){
            $business_data[] = [
                'business_id' => $business->business_id,
                'name' => $business->name,
                'address' => $business->local_address,
                'category' => $business->industry,
                'key' => $business->raw_code,
                'time_close' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
                'people_in_line' => Analytics::getBusinessRemainingCount($business->business_id),
                'serving_time' => '',
                'logo' => '',
            ];
        }

        return $business_data;
    }
}