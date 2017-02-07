<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 2/6/17
 * Time: 7:03 PM
 */

use utils\ApplePushNotifications;

class FreeQueueStatus
{

  public function postPunchQueuestatus($data = array()) {
    QueueStatus::savePunch($data);
    $business_id = Business::getBusinessIdByServiceId($data["service_id"]);
    $business_logins = DB::table('business_login')
      ->where('business_id', '=', $business_id)
      ->groupBy('device_token')
      ->get();
    foreach($business_logins as $login){
      $this->sendAppleNotification($login->device_token, 'Line is now in ' . $data["punch_type"] . 'status.', 'punch');
    }
    return json_encode(['status' => 201, 'msg' => 'OK']);
  }

  private function sendAppleNotification($device_token, $message, $msg_type){
    if(ctype_xdigit($device_token)){
      $APN = new \ApplePushNotifications($device_token, $message, null, $msg_type);
      $APN->sendNotif();
    }
  }
  
}