<?php
/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 6/2/15
 * Time: 2:48 PM
 */

class MessageForms extends Eloquent {
  protected $table = 'message_forms';
  public $timestamps = false;

  public static function createRecord($val = array()) {
    MessageForms::insert($val);
  }

}