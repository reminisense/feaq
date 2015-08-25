<?php

class AdImages extends Eloquent{

  protected $table = 'ad_images';
  protected $primaryKey = 'img_id';
  public $timestamps = false;

  public static function setWeight($weight, $img_id) {
    AdImages::where('img_id', '=', $img_id)->update(array('weight' => $weight));
  }

  public static function getAllImages() {
    return AdImages::orderBy('weight')->get();
  }

  public static function deleteImage($img_id) {
    AdImages::where('img_id', '=', $img_id)->delete();
  }

  public static function saveImages($path) {
    AdImages::insert(array(
      'path' => $path,
      'weight' => AdImages::max('weight') + 1,
    ));
  }

}