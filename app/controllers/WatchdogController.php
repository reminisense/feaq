<?php
/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 4/28/15
 * Time: 2:26 PM
 */

class WatchdogController extends BaseController{

  public function postWatch() {
    if (Auth::check()) {
      $post = json_decode(file_get_contents("php://input"));
      if ($post) {
        Watchdog::createRecord(array(
          'user_id' => Auth::user()->user_id,
          'action_type' => 'search',
          'value' => serialize(array(
            'keyword' => $post->keyword,
            'country' => $post->country,
            'industry' => $post->industry,
            'time_open' => $post->time_open,
            'timestamp' => time(),
          )),
        ));
      }
    }
  }

}