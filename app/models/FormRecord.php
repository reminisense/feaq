<?php
/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 6/23/16
 * Time: 11:52 AM
 */

class FormRecord extends Eloquent {

  protected $table = 'form_record';
  protected $primaryKey = 'record_id';
  public $timestamps = FALSE;

  public static function fetchRecordsByUserIdFormId($user_id, $form_id) {

  }

  public static function fetchAllRecordsByFormId($form_id) {

  }

  public static function getUserIdByRecordId($record_id) {

  }

  public static function getTransactionNumberByRecordId($record_id) {

  }

  public static function getXMLPathByRecordId($record_id) {

  }

}