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

    public static function getBusinesses($keyword = null, $offset = 0, $take = 10){
        return BusinessList::where('deleted_at', '=', '0000-00-00 00:00:00')
            ->where(function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('local_address', 'LIKE', '%' . $keyword . '%');
            })
            ->skip($offset)
            ->take($take)
            ->get();
    }
}