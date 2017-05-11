<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 5/10/17
 * Time: 1:49 PM
 */
class ServiceBoxes extends Eloquent {

  protected $table = 'service_boxes';
  protected $primaryKey = 'box_num';
  public $timestamps = FALSE;

  public static function fetchBoxes() {
    return ServiceBoxes::all();
  }

  public static function updateBoxes($box_num, $service_id, $service_name) {
    ServiceBoxes::where('box_num', '=', $box_num)
      ->update(array(
        'service_id' => $service_id,
        'service_name' => $service_name,
      ));
  }

}