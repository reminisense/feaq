<?php

/**
 * Created by PhpStorm.
 * User: Polljii143
 * Date: 5/15/17
 * Time: 4:49 PM
 */
class Pacing extends Eloquent
{
    protected $table = 'pacing';
    protected $primaryKey = 'pacing_id';
    public $timestamps = false;

    public static function addSlots($values = array()) {
        Pacing::insert($values);
    }

    public static function create_record($service_id, $quota, $time_start, $time_end){
        $pacing_record = [
            'service_id' => $service_id,
            'quota' => $quota,
            'time_start' => $time_start,
            'time_end' => $time_end
        ];

        Pacing::insertGetId($pacing_record);
    }

    public static function fetch_records($service_id){
        return Pacing::where('service_id', $service_id)->get();
    }


    public static function delete_record($pacing_id){
        return Pacing::where('pacing_id', '=', $pacing_id)->delete();
    }
}
