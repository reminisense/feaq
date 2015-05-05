<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 4/28/15
 * Time: 3:21 PM
 */

class ViewHistory extends Eloquent{
    protected $table = 'watchdog';
    protected $primaryKey = 'log_id';

    public static function addViewHistory($data){
        return ViewHistory::insertGetId($data);
    }

    public static function getPageViews($user_id = null){
        $user_data = [];
        if($user_id){
            $results = ViewHistory::where('user_id', '=', $user_id)->where('action_type', '=', 'page view')->get();
        }else{
            $results = ViewHistory::where('action_type', '=', 'page view')->get();
        }

        foreach($results as $index => $data){
            $user_data[$index] = unserialize($data->value);
            $user_data[$index]['user_id'] = $data->user_id;
            $user_data[$index]['action_type'] = $data->action_type;
        }
        return $user_data;
    }

    public static function queryUserParameters($keyword, $user_id = null){
        $user_data = ViewHistory::getPageViews($user_id);
        $values = [];
        foreach($user_data as $data){
            $values[] = $data[$keyword];
        }
        $numbers = array_count_values($values);
        return $numbers;
    }
}