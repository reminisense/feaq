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
      return json_encode(array(
        'fields' => $fields,
        'service_name' => $service_name,
        'form_name' => $form_name,
        'form_data' => $form_data,
        'transaction_number' => $transaction_number,
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