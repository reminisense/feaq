<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/28/15
 * Time: 6:55 PM
 */
class QueueSettingsController extends BaseController{
    public function getUpdate($business_id, $field, $value){
        $first_branch = Branch::where('business_id', '=', $business_id)->first();
        $services = Service::where('branch_id', '=', $first_branch->branch_id)->get();

        foreach($services as $service){
            if(QueueSettings::serviceExists($service->service_id)){
                QueueSettings::updateQueueSetting($service->service_id, $field, $value);
            }else{
                QueueSettings::createQueueSetting([
                    'service_id' => $service->service_id,
                    'date' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                    'number_start' => 1,
                    $field => $value
                ]);
            }
        }

        return json_encode(['success' => 1]);
    }

    public function getAllvalues($service_id){
        $values = QueueSettings::getServiceQueueSettings($service_id);
        $values->remote_time = QueueSettings::remoteTime($service_id);
        return json_encode(['success' => 1, 'queue_settings' => $values]);
    }

    public function getAssignterminal($terminal_id, $user_id){
        TerminalManager::addToTerminal($user_id, $terminal_id);
        return json_encode(['success' => 1]);
    }

    public function postSaveSettings(){
        $data = Input::all();
        $queue_settings = QueueSettings::where('service_id', '=', $data['service_id'])->first();
        $queue_settings->number_prefix = $data['number_prefix'];
        $queue_settings->number_start = $data['number_start'];
        $queue_settings->number_limit = $data['number_limit'];
        $queue_settings->terminal_specific_issue = $data['terminal_specific_issue'];
        $queue_settings->sms_current_number = $data['sms_current_number'];
        $queue_settings->sms_1_ahead = $data['sms_1_ahead'];
        $queue_settings->sms_5_ahead = $data['sms_5_ahead'];
        $queue_settings->sms_10_ahead = $data['sms_10_ahead'];
        $queue_settings->sms_blank_ahead = $data['sms_blank_ahead'];
        $queue_settings->input_sms_field = $data['input_sms_field'];
        $queue_settings->allow_remote = $data['allow_remote'];
        $queue_settings->remote_limit = $data['remote_limit'];
        $queue_settings->process_queue_layout = $data['process_queue_layout'];
        $queue_settings->check_in_display = $data['check_in_display'];
        $queue_settings->save();

        //sms settings
//        $sms_api_data = [];
//        $sms_gateway_api = NULL;
//        if ($data['sms_gateway'] == 'frontline_sms') {
//            $sms_api_data = [
//                'frontline_sms_url' => $data['frontline_sms_url'],
//                'frontline_sms_api_key' => $data['frontline_sms_api_key'],
//            ];
//            $sms_gateway_api = serialize($sms_api_data);
//        } elseif ($data['sms_gateway'] == 'twilio') {
//            if ($data['twilio_account_sid'] == TWILIO_ACCOUNT_SID &&
//                $data['twilio_auth_token'] == TWILIO_AUTH_TOKEN &&
//                $data['twilio_phone_number'] == TWILIO_PHONE_NUMBER
//            ) {
//                $business_data['sms_gateway'] = NULL;
//                $sms_gateway_api = NULL;
//            } else {
//                $sms_api_data = [
//                    'twilio_account_sid' => $data['twilio_account_sid'],
//                    'twilio_auth_token' => $data['twilio_auth_token'],
//                    'twilio_phone_number' => $data['twilio_phone_number'],
//                ];
//                $sms_gateway_api = serialize($sms_api_data);
//            }
//        }
//        QueueSettings::updateQueueSetting($data['service_id'], 'sms_gateway', $data['sms_gateway']);
//        QueueSettings::updateQueueSetting($data['service_id'], 'sms_gateway_api', $sms_gateway_api);
        QueueSettings::updateQueueSetting($data['service_id'], 'remote_time', $data['remote_time']);

        return json_encode(['success' => 1]);
    }
}