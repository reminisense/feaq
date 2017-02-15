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
    MeanServingTime::calculateFinalMean($data['service_id']);
  }

  public static function updateMeans($data = array(), $service_id) {
    MeanServingTime::where('service_id', '=', $service_id)->update($data);
    MeanServingTime::calculateFinalMean($service_id);
  }

  public static function isServiceExisting($service_id) {
    return MeanServingTime::where('service_id', '=', $service_id)->exists();
  }

  public static function fetchMeans($service_id) {
    return MeanServingTime::where('service_id', '=', $service_id)->first();
  }

  private static function calculateFinalMean($service_id) {
    $data = MeanServingTime::where('service_id', '=', $service_id)->first()->toArray();
    $today = $data['mean_today'] * $data['weight_today'];
    $yesterday = $data['mean_yesterday'] * $data['weight_yesterday'];
    $three_days = $data['mean_three_days'] * $data['weight_three_days'];
    $this_week = $data['mean_this_week'] * $data['weight_this_week'];
    $last_week = $data['mean_last_week'] * $data['weight_last_week'];
    $this_month = $data['mean_this_month'] * $data['weight_this_month'];
    $last_month = $data['mean_last_month'] * $data['weight_last_month'];
    $most_likely = $data['mean_most_likely'] * $data['weight_most_likely'];
    $most_optimistic = $data['mean_most_optimistic'] * $data['weight_most_optimistic'];
    $most_pessimistic = $data['mean_most_pessimistic'] * $data['weight_most_pessimistic'];
    $total_all = $today + $yesterday + $three_days + $this_week + $last_week + $this_month + $last_month + $most_likely + $most_optimistic + $most_pessimistic;
    $total_weights = $data['weight_today'] + $data['weight_yesterday'] + $data['weight_three_days'] + $data['weight_this_week']
      + $data['weight_last_week'] + $data['weight_this_month'] + $data['weight_last_month'] + $data['weight_most_likely']
      + $data['weight_most_optimistic'] + $data['weight_most_pessimistic'];
    $average_serving_time = $total_all / $total_weights;
    MeanServingTime::where('service_id', '=', $service_id)->update(array('final_mean' => $average_serving_time));
  }

}