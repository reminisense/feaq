<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 4/6/2016
 * Time: 10:47 AM
 */

class BusinessList extends Eloquent
{

    protected $table = 'business_list';
    protected $primaryKey = 'business_list_id';
    public $timestamps = true;

    public static function updateListByBatch($business_list_array){

        foreach($business_list_array as $business_list){
            $values = [
               'name' => $business_list['name'],
               'local_address' => $business_list['local_address'],
               'email' =>$business_list['email'],
               'phone' =>$business_list['phone'],
               'time_open' => $business_list['time_open'],
               'time_close' => $business_list['time_close']
            ];
            BusinessList::where('business_list_id','=',$business_list['business_list_id'])->update($values);
        }

        return true;
    }

    public static function getBusinessListByLikeName($business_name){
        return BusinessList::where('name', 'LIKE', '%' . $business_name . '%')->get();
    }


    public static function getBusinessListDetails($business_id)
    {

        $business_list = BusinessList::find($business_id);

        $business_list_details = [
            'business_list_id' => $business_list['business_list_id'],
            'name' => $business_list['name'],
            'local_address' => $business_list['local_address'],
            'email' => $business_list['email'],
            'phone' => $business_list['phone'],
            'time_open' => $business_list['time_open'],
            'time_close' => $business_list['time_close'],
            'deleted_at' => $business_list['deleted_at']
        ];

        return $business_list_details;
    }
}