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

    /**
     * Queue Settings
     */

    public static function numberStart($service_id, $date = null){
        return QueueSettings::queueSetting('number_start', 1, $service_id, $date);
    }

    public static function numberLimit($service_id, $date = null){
        $business_id = Business::getBusinessIdByServiceId($service_id);
        return Business::find($business_id)->queue_limit;
        //return QueueSettings::queueSetting('number_limit', 99, $service_id, $date);
    }

    public static function terminalSpecificIssue($service_id, $date = null){
        return QueueSettings::queueSetting('terminal_specific_issue', 0, $service_id, $date);
    }

    public static function frontlineSecret($service_id, $date = null){
        return QueueSettings::queueSetting('frontline_sms_secret', FRONTLINE_SMS_SECRET, $service_id, $date);
    }

    public static function frontlineUrl($service_id, $date = null){
        return QueueSettings::queueSetting('frontline_sms_url', FRONTLINE_SMS_URL, $service_id, $date);
    }

    public static function smsCurrentNumber($service_id, $date = null){
        return QueueSettings::queueSetting('sms_current_number', 0, $service_id, $date);
    }

    public static function smsOneAhead($service_id, $date = null){
        return QueueSettings::queueSetting('sms_1_ahead', 0, $service_id, $date);
    }

    public static function smsFiveAhead($service_id, $date = null){
        return QueueSettings::queueSetting('sms_5_ahead', 0, $service_id, $date);
    }

    public static function smsTenAhead($service_id, $date = null){
        return QueueSettings::queueSetting('sms_10_ahead', 0, $service_id, $date);
    }

    public static function smsBlankAhead($service_id, $date = null){
        return QueueSettings::queueSetting('sms_blank_ahead', 0, $service_id, $date);
    }

    public static function inputSmsField($service_id, $date = null){
        return QueueSettings::queueSetting('input_sms_field', 0, $service_id, $date);
    }


    /**
     * Bsic functions
     */

    public static function updateQueueSetting($service_id, $field, $value){
        QueueSettings::where('service_id', '=', $service_id)->update([$field => $value]);
    }

    public static function createQueueSetting($values){
        return QueueSettings::insertGetId($values);
    }

    public static function serviceExists($service_id){
        return isset(QueueSettings::where('service_id', '=', $service_id)->first()->service_id) ? true : false;
    }

    /**
     * @param $field = field name in db
     * @param $default = default value in case null or no row found
     * @param $service_id
     * @param null $date
     * @return mixed
     */
    public static function queueSetting($field, $default, $service_id, $date = null){
        $date = $date == null ? time() : $date;
        $queue_setting = QueueSettings::getServiceQueueSettings($service_id, $date);
        return isset($queue_setting->$field) && $queue_setting->$field ? $queue_setting->$field : $default;
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