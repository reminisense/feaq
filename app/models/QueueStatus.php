<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 2/6/17
 * Time: 7:17 PM
 */
class QueueStatus extends Eloquent
{

  protected $table = 'queue_status';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public static function savePunch($data = array()) {
    QueueStatus::insert($data);
  }

  public static function isPunchTypeExists($service_id) {
    return QueueStatus::where('service_id', '=', $service_id)->exists();
  }

  public static function getLatestPunchTypeByServiceId($service_id) {
    return QueueStatus::where('service_id', '=', $service_id)->orderBy('id','desc')->first()->punch_type;
  }

}