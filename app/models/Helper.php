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

    /**
     * gets the user id of the current user
     * @return mixed
     */
    public static function userId(){
        return Auth::user()->user_id;
    }

    /**
     * gets the role id of the current session's user
     * @return mixed
     */
    public static function currentUserRoleId(){
        return DB::table('user_role')->where('user_id', '=', Helper::userId())->first()->role_id;
    }

    /**
     * checks if the role of the current user is in the given array
     * @return mixed
     */
    public static function currentUserIsEither($roles = array()){
        return in_array(Helper::currentUserRoleId(), $roles);
    }

    public static function parseTime($time){
        $arr = explode(' ', $time);
        $hourmin = explode(':', $arr[0]);

        return [
            'hour' => trim($hourmin[0]),
            'min'  => trim($hourmin[1]),
            'ampm' => trim($arr[1]),
        ];
    }

    public static function mergeTime($hour, $min, $ampm){
        return Helper::doubleZero($hour).':'.Helper::doubleZero($min).' '.$ampm;
    }

    public static function doubleZero($number){
        return $number == 0 ? '00' : $number;
    }

    public static function millisecondsToHMSFormat($ms){
        $second = $ms % 60;
        $ms = floor($ms / 60);

        $minute = $ms % 60;
        $ms = floor($ms / 60);

        $hour = $ms % 24;
        return Helper::formatTime($second, $minute, $hour);
    }

    public static function formatTime($second, $minute, $hour){
        $time_string = '';
        $time_string .= $hour > 0 ? $hour . ' hour(s) ' : '';
        $time_string .= $minute > 0 ? $minute . ' minute(s) ' : '';
        $time_string .= $second > 0 ? $second . ' second(s) ' : '';
        return $time_string;
    }
}