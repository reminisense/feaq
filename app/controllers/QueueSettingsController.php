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
        try{
            $values = QueueSettings::getServiceQueueSettings($service_id);
            if($values){
                $values->remote_time = QueueSettings::remoteTime($service_id);
            }else{
                $values = QueueSettings::$defaults;
            }
            return json_encode(['success' => 1, 'queue_settings' => $values]);
        }catch(Exception $e){
            return json_encode(['success' => 0, 'message' => $e->getMessage()]);
        }

    }

    public function getAssignterminal($terminal_id, $user_id){
        TerminalManager::addToTerminal($user_id, $terminal_id);
        return json_encode(['success' => 1]);
    }

    public function postSaveSettings(){
        try{
            $data = Input::all();
            $queue_settings = QueueSettings::where('service_id', '=', $data['service_id'])->first();
            $queue_settings->number_prefix = $data['number_prefix'];
            $queue_settings->number_suffix = $data['number_suffix'];
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

            QueueSettings::updateQueueSetting($data['service_id'], 'remote_time', $data['remote_time']);
            return json_encode(['success' => 1, 'message' => 'Service settings have been saved.']);
        }catch (Exception $e){
            return json_encode(['success' => 0, 'message' => $e->getMessage()]);
        }

    }
}