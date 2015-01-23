<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 6:55 PM
 */

class UserBusiness extends Eloquent{

    protected $table = 'user_business';
    public $timestamps = false;

    public static function getBusinessIdByOwner($user_id) {
        return DB::table ( 'user_business' )
            ->select ( 'business_id' )
            ->where ( 'user_id', '=', $user_id )
            ->first ()->business_id;
    }
}