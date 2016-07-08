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

  public static function postCreateForm($service_id, $name, $fields, $path) {
      $data = [
          'service_id' => $service_id,
          'name' => $name,
          'fields' => $fields,
          'path' => $path
      ];
      return Forms::insert($data);
  }

  public static function fetchFormsByServiceId($service_id) {
      return Forms::where('service_id', '=', $service_id)->get();
  }

  public static function fetchFormsByFilter($filter, $value) {
      return Forms::where($filter, '=', $value)->get();
  }

  public static function getTitleByFormId($form_id) {
    return Forms::where('form_id', '=', $form_id)->select(array('form_name'))->first()->form_name;
  }

  public static function getServiceIdByFormId($form_id) {
    return Forms::where('form_id', '=', $form_id)->select(array('service_id'))->first()->service_id;
  }

  public static function getFieldsByFormId($form_id) {
    return Forms::where('form_id', '=', $form_id)->select(array('fields'))->first()->fields;
  }

}