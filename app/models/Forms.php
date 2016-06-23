<?php

class Forms extends Eloquent {

  protected $table = 'forms';
  protected $primaryKey = 'form_id';
  public $timestamps = FALSE;

  public static function createField($val = array()) {
    return Forms::insertGetId($val);
  }

  public static function getFieldsByBusinessId($business_id) {
    return Forms::where('business_id', '=', $business_id)->get();
  }

  public static function getFieldsByServiceId($service_id) {
      return Forms::where('service_id', '=', $service_id)->get();
  }

  public static function deleteField($form_id) {
    Forms::where('form_id', '=', $form_id)->delete();
  }

  public static function getLabelByFormId($form_id) {
    $field_data = Forms::where('form_id', '=', $form_id)->select(array('field_data'))->first()->field_data;
    $arr = unserialize($field_data);
    return $arr['label'];
  }

  public static function postCreateForm($service_id, $name, $fields) {

  }

  public static function fetchFormsByServiceId($service_id) {

  }

  public static function fetchFormsByFilter($filter) {

  }

  public static function getTitleByFormId($form_id) {

  }

  public static function getServiceIdByFormId($form_id) {

  }

  public static function fetchFieldsByFormId($form_id) {

  }

}