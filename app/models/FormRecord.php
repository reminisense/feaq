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
    return FormRecord::where('user_id', '=', $user_id)->where('form_id', '=', $form_id)->get();
  }

  public static function fetchAllRecordsByFormId($form_id) {
    return FormRecord::where('form_id', '=', $form_id)->get();
  }

  public static function getUserIdByRecordId($record_id) {
    return FormRecord::where('record_id', '=', $record_id)->select(array('user_id'))->first()->user_id;
  }

  public static function getTransactionNumberByRecordId($record_id) {
    return FormRecord::where('record_id', '=', $record_id)->select(array('transaction_number'))->first()->transaction_number;
  }

  public static function getXMLPathByRecordId($record_id) {
    return FormRecord::where('record_id', '=', $record_id)->select(array('record_path'))->first()->record_path;
  }

  public static function getFormIdByRecordId($record_id) {
    return FormRecord::where('record_id', '=', $record_id)->select(array('form_id'))->first()->form_id;
  }

//  public static function fetchAllXMLPathOfUserID($user_id){
//    return FormRecord::where('user_id', '=', $user_id)->select(array('record_path'))->get();
//  }

  public static function getRecordIdFormIdByTransactionNumber($transaction_number) {
    return FormRecord::where('transaction_number', '=', $transaction_number)->select(array('record_id', 'form_id'))->get();
  }

  public static function createRecord($transaction_number, $form_id, $user_id, $record_path) {
    $data = array(
      'transaction_number' => $transaction_number,
      'form_id' => $form_id,
      'user_id' => $user_id,
      'record_path' => $record_path,
    );
    FormRecord::insert($data);
  }

}