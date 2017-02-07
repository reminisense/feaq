<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 2/6/17
 * Time: 7:03 PM
 */
class FreeQueueStatus
{

  public function postPunchQueuestatus($data = array()) {
    QueueStatus::savePunch($data);
    return json_encode(['status' => 201, 'msg' => 'OK']);
  }
  
  
}