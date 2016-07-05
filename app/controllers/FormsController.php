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
                      'date_created' => $date->format('Y-m-d'),
                      'path' => $form->path,
                      'fields' => unserialize($form->fields)
                  );
              }
          }
          return json_encode(array('success'=> 1, 'forms' => $data));
      } else {
          return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
  }

  public function getServiceForms($service_id){
      if (Helper::isBusinessOwner(Business::getBusinessIdByServiceId($service_id), Helper::userId())) { // PAG added permission checking
          $data = array();
          $forms = Forms::fetchFormsByServiceId($service_id);
          foreach ($forms as $form) {
              $date = new DateTime($form->time_created);
              $data[] = array(
                  'form_id' => $form->form_id,
                  'form_name' => $form->form_name,
                  'service_id' => $form->service_id,
                  'service_name' => Service::name($form->service_id),
                  'date_created' => $date->format('Y-m-d'),
                  'date_created' => $form->time_created,
                  'path' => $form->path,
                  'fields' => unserialize($form->fields)
              );
          }
          return json_encode(array('success' => 1, 'forms' => $data));
      } else {
          return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
  }

    public function getFilteredForms($filter, $value,  $business_id){
        if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
            $data = array();
            $forms = Forms::fetchFormsByFilter($filter, $value);
            foreach ($forms as $form) {
                $date = new DateTime($form->time_created);
                $data[] = array(
                    'form_id' => $form->form_id,
                    'form_name' => $form->form_name,
                    'service_id' => $form->service_id,
                    'service_name' => Service::name($form->service_id),
                    'date_created' => $date->format('Y-m-d'),
                    'date_created' => $form->time_created,
                    'path' => $form->path,
                    'fields' => unserialize($form->fields)
                );
            }
            return json_encode(array('success' => 1, 'forms' => $data));
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
              'date' => date("D, M j, Y g:i A", strtotime($record->time_created)),
              'record_id' => $record->record_id,
            );
          }
          return json_encode(array(
            'fields' => $fields,
//            'service_name' => $service_name,
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

}