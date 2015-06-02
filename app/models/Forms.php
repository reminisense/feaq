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

  public static function deleteField($form_id) {
    Forms::where('form_id', '=', $form_id)->delete();
  }

}