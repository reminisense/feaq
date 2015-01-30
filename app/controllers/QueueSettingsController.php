<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/28/15
 * Time: 6:55 PM
 */
class QueueSettingsController extends BaseController{
    public function postUpdate($service_id){
        $field = Input::get('field');
        $value = Input::get('value');

        if(QueueSettings::serviceExists($service_id)){
            QueueSettings::updateQueueSetting($service_id, $field, $value);
        }else{
            QueueSettings::createQueueSetting([
                'service_id' => $service_id,
                'date' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                $field => $value
            ]);
        }

        return json_encode(['success' => 1]);
    }

    public function getAllvalues($service_id){
        $values = QueueSettings::getServiceQueueSettings($service_id);
        $queue_settings = [
            'number_start' => $values->number_start,
            'number_limit' => $values->number_limit,
            'auto_issue' => $values->auto_issue,
            'allow_sms' => $values->allow_sms,
            'allow_remote' => $values->allow_remote,
        ];

        return json_encode(['success' => 1, 'queue_settings' => $queue_settings]);
    }
}