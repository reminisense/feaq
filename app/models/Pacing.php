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

    public static function createPace($pace){
//        $pacing_record = [
//            'service_id' => $pace['service_id'],
//            'quota' => $pace['quota'],
//            'time_start' => $pace['time_start'],
//            'time_end' => $pace['time_end']
//        ];

        Pacing::insertGetId($pace);
    }

    public static function fetchPacesByService($service_id){
        return Pacing::where('service_id', $service_id)->get();
    }


    public static function deletePace($pacing_id){
        return Pacing::where('pacing_id', '=', $pacing_id)->delete();
    }
}
