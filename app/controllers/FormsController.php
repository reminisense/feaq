<?php

class FormsController extends BaseController{

  public function getDisplayForms($business_id) {
      if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
          $data = array();
          $services = Service::getServicesByBusinessId($business_id);
          foreach($services as $service){
              $forms = Forms::fetchFormsByServiceId($service->service_id);
              foreach ($forms as $form) {
                  $data[] = array(
                      'form_id' => $form->form_id,
                      'form_name' => $form->form_name,
                      'service_id' => $form->service_id,
                      'fields' => unserialize($form->fields)
                  );
              }
          }
          return json_encode(array('success'=> 1, 'data' => $data));
      } else {
          return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
  }

  public function  getServiceForms($service_id){
      if (Helper::isBusinessOwner(Business::getBusinessIdByServiceId($service_id), Helper::userId())) { // PAG added permission checking
          $data = array();
          $forms = Forms::fetchFormsByServiceId($service_id);
          foreach ($forms as $form) {
              $data[] = array(
                  'form_id' => $form->form_id,
                  'form_name' => $form->form_name,
                  'service_id' => $form->service_id,
                  'fields' => unserialize($form->fields)
              );
          }
          return json_encode(array('success' => 1, 'data' => $data));
      } else {
          return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
  }

    public function  getFilteredForms($filter, $value,  $business_id){
        if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
            $data = array();
            $forms = Forms::fetchFormsByFilter($filter, $value);
            foreach ($forms as $form) {
                $data[] = array(
                    'form_id' => $form->form_id,
                    'form_name' => $form->form_name,
                    'service_id' => $form->service_id,
                    'fields' => unserialize($form->fields)
                );
            }
            return json_encode(array('success' => 1, 'data' => $data));
        } else {
            return json_encode(array('message' => 'You are not allowed to access this function.'));
        }
    }

    public function postSaveForm(){
        if (Helper::isBusinessOwner(Business::getBusinessIdByServiceId(Input::get('service_id')), Helper::userId())) { // PAG added permission checking

            $service_id = Input::get('service_id');
            $form_tag = count(Forms::fetchFormsByServiceId($service_id))+1;
            $name = Input::get('name');
            $fields = Input::get('fields');
            $path = 'public/xml/form_'.$service_id.'_'.$form_tag.'.xml';

            $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><data></data>");

            Helper::array_to_xml($fields,$xml);

            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom->formatOutput = true;
            $dom->saveXML();
            file_put_contents('', $dom->saveXML());

            Forms::postCreateForm($service_id ,$name,serialize($fields), $path);
            return json_encode(array('success'=>1));
        }
    }
}