<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:21 PM
 */

class PriorityNumber extends Eloquent {

    protected $table = 'priority_number';
    protected $primaryKey = 'track_id';
    public $timestamps = false;

    public static function createPriorityNumber($service_id, $number_start, $number_limit, $last_number_given, $current_number, $date, $user_id){
        $values = [
            'service_id' => $service_id,
            'number_start' => $number_start,
            'number_limit' => $number_limit,
            'last_number_given' => $last_number_given,
            'current_number' => $current_number,
            'date' => $date
        ];
        Helper::dbLogger('PriorityNumber', 'priority_number', 'insert', 'createPriorityNumber', User::email($user_id), 'service_id:' . $service_id . ', current_number:' . $current_number);
        return PriorityNumber::insertGetId($values);
    }

    public static function serviceId($track_id){
        return PriorityNumber::find($track_id)->service_id;
    }

  public static function getTrackIdByServiceId($service_id) {
    return PriorityNumber::where('service_id', '=', $service_id)->select(array('track_id'))->get();
  }

}