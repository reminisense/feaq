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
        $business_id = Business::getBusinessIdByServiceId($service_id);
        return Business::find($business_id)->queue_limit;
        //return QueueSettings::queueSetting('number_limit', 99, $service_id, $date);
    }

    public static function updateQueueSetting($service_id, $field, $value){
        QueueSettings::where('service_id', '=', $service_id)->update([$field => $value]);
    }

    public static function createQueueSetting($values){
        return QueueSettings::insertGetId($values);
    }

    public static function serviceExists($service_id){
        return isset(QueueSettings::where('service_id', '=', $service_id)->first()->service_id) ? true : false;
    }

    public static function queueSetting($field, $default, $service_id, $date = null){
        $date = $date == null ? time() : $date;
        $queue_setting = QueueSettings::getServiceQueueSettings($service_id, $date);
        return isset($queue_setting->$field) ? $queue_setting->$field : $default;
    }

    public static function getServiceQueueSettings($service_id, $date = null){
        $date = $date == null ? time() : $date;
        $queue_setting = QueueSettings::where('service_id', '=', $service_id)
            ->where('date', '<=', $date)
            ->orderBy('queue_setting_id', 'desc')
            ->orderBy('date', 'asc')
            ->first();
        return $queue_setting;
    }
}