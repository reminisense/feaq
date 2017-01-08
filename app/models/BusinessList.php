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


    public static function getBusinessListDetails($business_list_id)
    {

        $business_list = BusinessList::find($business_list_id);

        $business_list_details = [
            'business_list_id' => $business_list['business_list_id'],
            'business_id' => $business_list['business_id'],
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

    public static function getBusinesses($location, $keyword, $offset, $take){
        if(strlen($keyword) == 1){
            return BusinessList::where('deleted_at', '=', '0000-00-00 00:00:00')
                ->where('local_address', 'LIKE', '%' . $location . '%')
                ->where('name', 'LIKE', $keyword . '%')
                ->skip($offset)
                ->take($take)
                ->get();
        }else{
            return BusinessList::where('deleted_at', '=', '0000-00-00 00:00:00')
                ->where('local_address', 'LIKE', '%' . $location . '%')
                ->where(function ($query) use ($location, $keyword) {
                    return $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('local_address', 'LIKE', '%' . $keyword . '%');
                })
                ->skip($offset)
                ->take($take)
                ->get();
        }
    }

    public static function fetchBusinessByLetterOffset($letter = "", $offset = 0) {
        return BusinessList::where('name', 'LIKE', $letter . '%')->orderBy('name')->skip($offset)->take(20)->get();
    }

    public static function fetchAllBusinessByOffset($offset = 0) {
        return BusinessList::orderBy('name')->where('deleted_at','=','0000-00-00 00:00:00')->skip($offset)->take(20)->get();
    }

    public static function updateUpvoteById($business_list_id) {
        $up_vote = BusinessList::getUpvoteById($business_list_id) + 1;
        BusinessList::where('business_list_id', '=', $business_list_id)->update(array('up_vote' => $up_vote));
    }

    public static function getUpvoteById($business_list_id) {
        return BusinessList::where('business_list_id', '=', $business_list_id)->select(array('up_vote'))->first()->up_vote;
    }

    public static function getBusinessListIdByName($name){
        return BusinessList::select('business_list_id')->where('name', $name)->first();
    }
}