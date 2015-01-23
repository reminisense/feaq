<?php
/**
 * ARA - Helper class
 *
 * functions that can be used across different models/controllers
 * should be placed in this class
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 2:37 PM
 */

class Helper extends Eloquent {

    public static function allNumbers($service_id){
        return array();
    }

    /**
     * gets the role id of the current session's user
     * @return mixed
     */
    public static function currentUserRoleId(){
        return DB::table('user_role')->where('user_id', '=', Auth::user()->user_id)->first()->role_id;
    }

    /**
     * checks if the role of the current user is in the given array
     * @return mixed
     */
    public static function currentUserIsEither($roles = array()){
        return in_array(Helper::currentUserRoleId(), $roles);
    }

}