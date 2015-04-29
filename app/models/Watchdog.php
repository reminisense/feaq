<?php
/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 4/28/15
 * Time: 2:20 PM
 */

class Watchdog extends Eloquent {

  protected $table = 'watchdog';
  protected $primaryKey = 'log_id';
  public $timestamps = false;

  public static function createRecord($val = array()) {
    Watchdog::insert($val);
  }

}