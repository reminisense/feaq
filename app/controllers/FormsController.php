<?php

class FormsController extends BaseController{

  public function getDisplayForms($business_id) {
      if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
          $data = array();
          $services = Service::getServicesByBusinessId($business_id);
          foreach($services as $service){
              $forms = Forms::fetchFormsByServiceId($service->service_id);
              foreach ($forms as $form) {
                  $date = new DateTime($form->time_created);
                  $data[] = array(
                      'form_id' => $form->form_id,
                      'form_name' => $form->form_name,
                      'service_id' => $form->service_id,
                      'service_name' => Service::name($form->service_id),
                      'date_created' => $date->format('F d, Y'),
                      'path' => $form->xml_path,
                      'fields' => unserialize($form->fields),
                      'status' => $form->status ? true:false
                  );
              }
          }
          return json_encode(array('success'=> 1, 'forms' => $data));
      } else {
          return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
  }

    public function getViewForm($form_id) {
        $service_id = Forms::getServiceIdByFormId($form_id);
        $business_id = Business::getBusinessIdByServiceId($service_id);
        if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
          $record_list = array();
          $form_name = Forms::getTitleByFormId($form_id);
          $service_name = Service::name($service_id);
          $fields = unserialize(Forms::getFieldsByFormId($form_id));
          $records = FormRecord::fetchAllRecordsByFormId($form_id);
          foreach ($records as $count => $record) {
            $record_list[] = array(
              'full_name' => User::first_name($record->user_id) . ' ' . User::last_name($record->user_id),
              'transaction_number' => $record->transaction_number,
              'date' => date('F d, Y', strtotime($record->time_created)),
              'record_id' => $record->record_id,
            );
          }
          return json_encode(array(
            'fields' => $fields,
              'service_name' => $service_name,
            'form_name' => $form_name,
            'records' => $record_list,
          ));
        }
        else {
            return json_encode(array(
              'status' => 403,
              'msg' => 'You are not allowed to access this function.',
            ));
        }
    }

    public function postSaveForm(){
        if (Helper::isBusinessOwner(Business::getBusinessIdByServiceId(Input::get('service_id')), Helper::userId())) { // PAG added permission checking
            $service_id = Input::get('service_id');
            $name = Input::get('name');
            $fields = Input::get('fields');
            $form_tag = count(Forms::fetchFormsByServiceId($service_id))+1;
            $form_data = array();

            $to_xml = array(
                'form_name' => $name,
                'service_id' => $service_id,
            );

            foreach($fields as $field){
                $form_data[preg_replace('/[^a-z]/', "", strtolower($field['field_data']['label']))] = '';
            }

            $to_xml['form_data'] = $form_data;

            $path = 'public/forms/templates/form_'.$service_id.'_'.$form_tag.'.xml';

            $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><xml></xml>");

            Helper::array_to_xml($to_xml,$xml);

            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom->formatOutput = true;
            $dom->saveXML($dom,LIBXML_NOEMPTYTAG);
            file_put_contents($path, $dom->saveXML($dom,LIBXML_NOEMPTYTAG));


            Forms::postCreateForm($service_id ,$name,serialize($fields), $path);
            return json_encode($to_xml);
        }
    }

    public function postSaveStatus(){

           $form_id = Input::get('form_id');
           $status = Input::get('status');

           $form = Forms::find($form_id);
           $form->status = $status;
           $form->save();

          return json_encode(array('success'=> 1));
    }

}