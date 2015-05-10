<?php
/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 4/28/15
 * Time: 2:20 PM
 */

class Watchdog extends Eloquent {

    protected $table = 'watchdog';
    protected $primaryKey = 'log_id';
    public $timestamps = false;

    public static function createRecord($val = array()) {
        return Watchdog::insertGetId($val);
    }

    public static function getUserRecords($user_id = null){
        $user_data = [];
        if($user_id){
            $results = Watchdog::where('user_id', '=', $user_id)->get();
        }else{
            $results = Watchdog::all();
        }

        foreach($results as $index => $data){
            $user_data[$index] = unserialize($data->value);
            $user_data[$index]['user_id'] = $data->user_id;
            $user_data[$index]['action_type'] = $data->action_type;
        }
        return $user_data;
    }

    public static function queryUserInfo($keyword, $user_id = null){
        $user_data = Watchdog::getUserRecords($user_id);
        $values = [];
        foreach($user_data as $data){
            if(isset($data[$keyword])) $values[] = $data[$keyword];
        }
        $numbers = array_count_values($values);
        return $numbers;
    }
}