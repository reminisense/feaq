<?php
/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 8/3/16
 * Time: 4:25 PM
 */

class UserDevice extends Eloquent {

  protected $table = 'user_device';
  protected $primaryKey = 'device_token';
  public $timestamps = false;

  public static function saveDeviceToken($deviceToken, $deviceType, $fbId) {
    UserDevice::insert(array(
      'device_token' => $deviceToken,
      'device_type' => $deviceType,
      'fb_id' => $fbId,
    ));
  }

  public static function getDeviceTokensByFbId($fbId) {
    return UserDevice::where('fb_id', '=', $fbId)->select(array('device_token'))->get();
  }

  public static function checkForDevice($fbId) {
    return UserDevice::where('fb_id', '=', $fbId)->exists();
  }

}