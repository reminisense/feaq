<?php

/**
 * Created by PhpStorm.
 * User: Polljii143
 * Date: 5/24/17
 * Time: 4:51 PM
 */
class Grouping extends Eloquent
{

    protected $table = 'grouping';
    protected $primaryKey = 'group_id';
    public $timestamps = false;

    public static function fetchGroupsByBusiness($business_id)
    {
        return Grouping::where('business_id', '=', $business_id)->get();
    }

    public static function createGroup($val = array())
    {
        Grouping::insert($val);
    }

    public static function deleteGroup($group_id)
    {
        Grouping::where('group_id', '=', $group_id)->delete();
    }

}