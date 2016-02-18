<?php

class AdImages extends Eloquent{

  protected $table = 'ad_images';
  protected $primaryKey = 'img_id';
  public $timestamps = false;

  public static function setWeight($weight, $img_id) {
    AdImages::where('img_id', '=', $img_id)->update(array('weight' => $weight));
    Helper::dbLogger('AdImages', 'ad_images', 'update', 'setWeight', User::email(Helper::userId()), 'img_id:' . $img_id);
  }

  public static function getAllImagesByBusinessId($business_id) {
    return AdImages::where('business_id', '=', $business_id)->orderBy('weight')->get();
  }

  public static function deleteImage($img_id) {
    AdImages::where('img_id', '=', $img_id)->delete();
    Helper::dbLogger('AdImages', 'ad_images', 'delete', 'deleteImage', User::email(Helper::userId()), 'img_id:' . $img_id);
  }

  public static function deleteImageByPath($path) {
    AdImages::where('path', '=', $path)->delete();
    Helper::dbLogger('AdImages', 'ad_images', 'delete', 'deleteImageByPath', User::email(Helper::userId()), 'path:' . $path);
  }

  public static function saveImages($path, $business_id) {
    AdImages::insert(array(
      'business_id' => $business_id,
      'path' => $path,
      'weight' => AdImages::max('weight') + 1,
    ));
    Helper::dbLogger('AdImages', 'ad_images', 'insert', 'saveImages', User::email(Helper::userId()), 'business_id:' . $business_id .
      ', path:' . $path);
  }

}