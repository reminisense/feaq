<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 1/13/17
 * Time: 3:50 PM
 */
class MeanServingTime extends Eloquent
{

  protected $table = 'mean_serving_time';
  protected $primaryKey = 'service_id';
  public $timestamps = false;

  public static function saveMeans($data = array()) {
    MeanServingTime::insert($data);
  }

  public static function updateMeans($data = array(), $service_id) {
    MeanServingTime::where('service_id', '=', $service_id)->update($data);
  }

  public static function isServiceExisting($service_id) {
    return MeanServingTime::where('service_id', '=', $service_id)->exists();
  }

  public static function fetchMeans($service_id) {
    return MeanServingTime::where('service_id', '=', $service_id)->get();
  }

  public static function calculateFinalMean() {
    
  }

}