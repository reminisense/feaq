<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/26/15
 * Time: 12:48 PM
 */

class QueueSettings extends Eloquent{
    protected $table = 'queue_settings';
    protected $primaryKey = 'queue_setting_id';
    public $timestamps = false;


    public static function numberStart($service_id, $date = null){
        return QueueSettings::queueSetting('number_start', 1, $service_id, $date);
    }

    public static function numberLimit($service_id, $date = null){
        return QueueSettings::queueSetting('number_limit', 99, $service_id, $date);
    }

    public static function queueSetting($field, $default, $service_id, $date = null){
        $date = $date == null ? time() : $date;
        $queue_setting = DB::table('queue_settings')
            ->where('service_id', '=', $service_id)
            ->where('date', '<=', $date)
            ->orderBy('queue_setting_id', 'desc')
            ->orderBy('date', 'asc')
            ->first();
        return isset($queue_setting->$field) ? $queue_setting->$field : $default;
    }

}