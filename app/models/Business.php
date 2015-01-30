<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:20 PM
 */

class Business extends Eloquent{

    protected $table = 'business';
    protected $primaryKey = 'business_id';
    public $timestamps = false;

    public static function name($business_id){
        return Business::where('business_id', '=', $business_id)->select(array('name'))->first()->name;
    }

}