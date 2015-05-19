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
        if(Auth::check()){
            return Auth::user()->user_id;
        }else{
            return 0;
        }
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

    public static function customSort($property, $var1, $var2){
        return $var1[$property] - $var2[$property];
    }

    public static function customSortRev($property, $var1, $var2){
        return $var2[$property] - $var1[$property];
    }

    public static function firstFromTable($table, $field, $value, $operator = '='){
        return DB::table($table)->where($field, $operator, $value)->first();
    }

    /**
     * requires an array of arrays
     * ex. 'field' => array('conditional_operator', 'value')
     * @param $conditions
     * @return mixed
     */
    public static function getMultipleQueries($table, $conditions){
        $query = DB::table($table);
        foreach($conditions as $field => $value){
            if(is_array($value)){
                $query->where($field, $value[0], $value[1]);
            }else{
                $query->where($field, '=', $value);
            }
        }
        return $query->get();
    }


    public static function getIP()
    {
        return $_SERVER["REMOTE_ADDR"];

        // populate a local variable to avoid extra function calls.
        // NOTE: use of getenv is not as common as use of $_SERVER.
        //       because of this use of $_SERVER is recommended, but
        //       for consistency, I'll use getenv below
        $tmp = getenv("HTTP_CLIENT_IP");
        // you DON'T want the HTTP_CLIENT_ID to equal unknown. That said, I don't
        // believe it ever will (same for all below)
        if ( $tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        $tmp = getenv("HTTP_X_FORWARDED_FOR");
        if( $tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        // no sense in testing SERVER after this.
        // $_SERVER[ 'REMOTE_ADDR' ] == gentenv( 'REMOTE_ADDR' );
        $tmp = getenv("REMOTE_ADDR");
        if($tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        return("unknown");
    }

    /**
     * @param $birthdate must be int ex. strtotime(1/1/1990)
     */
    public static function getAge($birthdate){
        return floor( (time() - $birthdate) / 31556926);
    }
}