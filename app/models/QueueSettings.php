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

    public static function numberPrefix($service_id, $date = null){
        return QueueSettings::queueSetting('number_prefix', '', $service_id, $date);
    }

    public static function numberSuffix($service_id, $date = null){
        return QueueSettings::queueSetting('number_suffix', '', $service_id, $date);
    }

    public static function numberStart($service_id, $date = null){
        return QueueSettings::queueSetting('number_start', 1, $service_id, $date);
    }

    public static function numberLimit($service_id, $date = null){
        //$business_id = Business::getBusinessIdByServiceId($service_id);
        //return Business::find($business_id)->queue_limit;
        return QueueSettings::queueSetting('number_limit', 99, $service_id, $date);
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

    public static function allowRemote($service_id, $date = null){
        return QueueSettings::queueSetting('allow_remote', 0, $service_id, $date);
    }

    public static function remoteLimit($service_id, $date = null){
        return QueueSettings::queueSetting('remote_limit', 0, $service_id, $date);
    }

    public static function remoteTime($service_id, $date = null){
        $hour = QueueSettings::queueSetting('remote_hour', 12, $service_id, $date);
        $min = QueueSettings::queueSetting('remote_min', 0, $service_id, $date);
        $ampm = QueueSettings::queueSetting('remote_ampm', 'AM', $service_id, $date);
        return Helper::mergeTime($hour, $min, $ampm);
    }

    public static function smsGateway($service_id, $date = null){
        return QueueSettings::queueSetting('sms_gateway', 'twilio', $service_id, $date);
    }

    public static function smsGatewayApi($service_id, $date = null){
        return QueueSettings::queueSetting('sms_gateway_api', serialize(QueueSettings::$sms_gateway_api['twilio']), $service_id, $date);
    }

    public static function processQueueLayout($service_id, $date = null){
        return QueueSettings::queueSetting('process_queue_layout', 0, $service_id, $date);
    }

    public static function checkInDisplay($service_id, $date = null){
        return QueueSettings::queueSetting('check_in_display', 0, $service_id, $date);
    }


    /**
     * SMS Gateway variables
     */

    private static $sms_gateway_api = [
        'frontline_sms' => [
            'frontline_sms_url' => FRONTLINE_SMS_URL,
            'frontline_sms_api_key' => FRONTLINE_API_KEY,
        ],

        'twilio' => [
            'twilio_account_sid' => TWILIO_ACCOUNT_SID,
            'twilio_auth_token' => TWILIO_AUTH_TOKEN,
            'twilio_phone_number' => TWILIO_PHONE_NUMBER,
        ],
    ];


    /**
     * Basic functions
     */

    public static function updateQueueSetting($service_id, $field, $value){
        if($field == 'remote_time'){
            QueueSettings::setRemoteTime($service_id, $value);
        }else{
            QueueSettings::where('service_id', '=', $service_id)->update([$field => $value]);
        }
        Helper::dbLogger('QueueSettings', 'queue_settings', 'update', 'updateQueueSetting', User::email(Helper::userId()), 'service_id:' . $service_id);
    }

    public static function createQueueSetting($values){
        Helper::dbLogger('QueueSettings', 'queue_settings', 'update', 'createQueueSetting', User::email(Helper::userId()));
        return QueueSettings::insertGetId($values);
    }

    public static function serviceExists($service_id){
        return isset(QueueSettings::where('service_id', '=', $service_id)->first()->service_id) ? true : false;
    }

    public static function setRemoteTime($service_id, $time){
        $remote_time = Helper::parseTime($time);
        $data = [
            'remote_hour' => $remote_time['hour'],
            'remote_minute' => $remote_time['min'],
            'remote_ampm' => $remote_time['ampm'],
        ];
        QueueSettings::where('service_id', '=', $service_id)->update($data);
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

    public static function checkRemoteQueue($service_id){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $allow_remote = QueueSettings::allowRemote($service_id);
        $remote_limit = QueueSettings::remoteLimit($service_id);
        $remote_time = QueueSettings::remoteTime($service_id);

        $total_numbers_today = PriorityNumber::where('date', '=', $date)
            ->select(DB::raw('COUNT(priority_number.track_id) as total_numbers_today'))
            ->first()
            ->total_numbers_today;
        $total_remote_today = PriorityNumber::where('date', '=', $date)
            ->join('priority_queue', 'priority_queue.track_id' , '=', 'priority_number.track_id')
            ->where(function($query){
                $query->where('priority_queue.queue_platform' , '=', 'remote')
                    ->orWhere('priority_queue.queue_platform' , '=', 'android');
            })
            ->select(DB::raw('COUNT(priority_number.track_id) as total_remote_today'))
            ->first()
            ->total_remote_today;

        $remote_queue_value = floor($total_numbers_today * ($remote_limit / 100));
        $result = $allow_remote && ($remote_queue_value > $total_remote_today) && (time() > strtotime($remote_time)) ? true : false;

        return $result;
    }
}