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
}