<?php
/**
 *
 * Should contain functions related to the broadcast page
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:11 PM
 */

class AdvertisementController extends BaseController{

  public function postUploadImage() {
    if(isset($_POST)) {
      if (Helper::isBusinessOwner($_POST['business_id'], Helper::userId())) { // PAG added permission checking
        $target_dir = public_path() . '/ads/';
        $target_file = $target_dir . basename($_FILES["ad_image"]["name"]);

        if (move_uploaded_file($_FILES["ad_image"]["tmp_name"], $target_file)) {
          $data = json_decode(file_get_contents(public_path() . '/json/' . $_POST['business_id'] . '.json'));
          $data->ad_image = '/ads/' . basename($_FILES["ad_image"]["name"]);
          $encode = json_encode($data);
          file_put_contents(public_path() . '/json/' . $_POST['business_id'] . '.json', $encode);
          return json_encode(array('src' => '/ads/' . basename($_FILES["ad_image"]["name"])));
        }
        else {
          return json_encode(array('status' => 'Something went wrong..'));
        }
      }
      else {
        return json_encode(array('status' => 'You are not allowed to access this function.'));
      }
    }
    else {
      return json_encode(array('status' => 'Something went wrong..'));
    }

  }

  public function postEmbedVideo() {
    $post = json_decode(file_get_contents("php://input"));
    if ($post) {
      if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
        $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
        $data->ad_video = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $post->ad_video);
        $encode = json_encode($data);
        file_put_contents(public_path() . '/json/' . $post->business_id . '.json', $encode);
        return json_encode(array('ad_video' => $data->ad_video));
      }
      else {
        return json_encode(array('status' => 'You are not allowed to access this function.'));
      }
    }
    else {
      return json_encode(array('status' => 'Something went wrong..'));
    }
  }

  public function postTvSelect() {
    $post = json_decode(file_get_contents("php://input"));
    if ($post) {
      if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
        $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
        //$data->ad_video = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $_POST['ad_video']);
        $data->tv_channel = $post->tv_channel;
        $encode = json_encode($data);
        file_put_contents(public_path() . '/json/' . $post->business_id . '.json', $encode);
      }
      else {
        return json_encode(array('status' => 'You are not allowed to access this function.'));
      }
    }
    else {
      return json_encode(array('status' => 'Something went wrong..'));
    }
  }

  public function postTurnOnTv() {
    $post = json_decode(file_get_contents("php://input"));
    if ($post) {
      if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
        $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
        //$data->ad_video = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $_POST['ad_video']);
        $data->turn_on_tv = $post->status;
        $encode = json_encode($data);
        file_put_contents(public_path() . '/json/' . $post->business_id . '.json', $encode);
        //return json_encode(array('turn_on_tv' => $data->turn_on_tv));
      }
      else {
        return json_encode(array('status' => 'You are not allowed to access this function.'));
      }
    }
    else {
      return json_encode(array('status' => 'Something went wrong..'));
    }
  }

  public function postAdType() {
    $post = json_decode(file_get_contents("php://input"));
    if ($post) {
      if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
        $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
        $data->ad_type = $post->ad_type;
        $encode = json_encode($data);
        file_put_contents(public_path() . '/json/' . $post->business_id . '.json', $encode);
        //return json_encode(array('ad_type' => $data->ad_type));
      }
      else {
        return json_encode(array('status' => 'You are not allowed to access this function.'));
      }
    }
    else {
      return json_encode(array('status' => 'Something went wrong..'));
    }
  }

  public function postSaveTicker() {
    $business_id = Input::get('business_id');
    if (Helper::isBusinessOwner($business_id, Helper::userId())) { // PAG added permission checking
      $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
      $data->ticker_message = Input::get('ticker_message');
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . $business_id . '.json', $encode);
    }
    else {
      return json_encode(array('status' => 'You are not allowed to access this function.'));
    }
  }

}