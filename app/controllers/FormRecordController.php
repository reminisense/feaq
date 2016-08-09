<?php
/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 6/27/16
 * Time: 5:21 PM
 */

class FormRecordController extends BaseController {

  public function getViewRecords($form_id) {
    $service_id = Forms::getServiceIdByFormId($form_id);
    $business_id = Business::getBusinessIdByServiceId($service_id);
    if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
      $records = FormRecord::fetchAllRecordsByFormId($form_id);
      return $records;
    }
    else {
      return json_encode(array(
        'status' => 403,
        'msg' => 'You are not allowed to access this function.',
      ));
    }
  }

  public function getSearchRecords($form_id, $full_name) {
    $service_id = Forms::getServiceIdByFormId($form_id);
    $business_id = Business::getBusinessIdByServiceId($service_id);
    if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
      $arr = array();
      $users = User::searchByKeyword($full_name);
      foreach ($users as $count => $user) {
        $arr[] = FormRecord::fetchRecordsByUserIdFormId($user->user_id, $form_id);
      }
      return json_encode($arr);
    }
    else {
      return json_encode(array(
        'status' => 403,
        'msg' => 'You are not allowed to access this function.',
      ));
    }
  }

  public function getViewUser($record_id) {
    $form_id = FormRecord::getFormIdByRecordId($record_id);
    $service_id = Forms::getServiceIdByFormId($form_id);
    $business_id = Business::getBusinessIdByServiceId($service_id);
    if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
      $form_id = FormRecord::getFormIdByRecordId($record_id);
      $form_name = Forms::getTitleByFormId($form_id);
      $service_name = Service::name($service_id);
      $fields = unserialize(Forms::getFieldsByFormId($form_id));
      $form_data = FormRecord::getXMLPathByRecordId($record_id);
      $transaction_number = FormRecord::getTransactionNumberByRecordId($record_id);
      $user_id = FormRecord::getUserIdByRecordId($record_id);
      $transaction_history = PriorityQueue::getTransactionHistory($transaction_number);
      return json_encode(array(
        'fields' => $fields,
        'service_name' => $service_name,
        'form_id' => $form_id,
        'form_name' => $form_name,
        'form_data' => simplexml_load_string(file_get_contents($form_data)),
        'transaction_number' => $transaction_number,
        'transaction_history' => $transaction_history,
        'full_name' => User::first_name($user_id) . ' ' . User::last_name($user_id),
      ));
    }
    else {
      return json_encode(array(
        'status' => 403,
        'msg' => 'You are not allowed to access this function.',
      ));
    }
  }

  public function postSaveRecords(){
      $user_id = Input::get('user_id');
      $transaction_number = Input::get('transaction_number');
      $form_submissions = Input::get('form_submissions');

      foreach ($form_submissions as $count => $form){
          $form_submit =  array_filter($form);;
          foreach ($form_submit as $form_id => $submit_data) {
              $to_xml = array(
                  'form_name' => Forms::getTitleByFormId($form_id),
                  'service_id' => Input::get('service_id'),
              );
              $form_data = array();
              $form_tag = count(FormRecord::fetchAllRecordsByFormId($form_id))+1;
              foreach ($submit_data as $count2 => $xml_data) {
                  $form_data[preg_replace('/[^a-z]/', "", strtolower($xml_data["xml_tag"]))] = $xml_data["xml_val"];
              }
              $to_xml['form_data'] = $form_data;
              $path = 'forms/records/form_'.$transaction_number.'_'.$form_id.'_'.$form_tag.'.xml';
              $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><xml></xml>");
              Helper::array_to_xml($to_xml,$xml);
              $dom = dom_import_simplexml($xml)->ownerDocument;
              $dom->formatOutput = true;
              $dom->saveXML($dom,LIBXML_NOEMPTYTAG);
              file_put_contents($path, $dom->saveXML($dom,LIBXML_NOEMPTYTAG));
              FormRecord::createRecord($transaction_number, $form_id, $user_id, $path);
          }
      }
      return json_encode(array(
          'status' => 201,
          'msg' => 'OK'
      ));
  }
}