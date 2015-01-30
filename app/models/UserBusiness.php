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
        $row = UserBusiness::where('user_id', '=', $user_id)->get()->first();

        if (count($row) > 0){
            return $row->business_id;
        } else {
            return false;
        }
    }
}