<?php

/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 1/5/15
 * Time: 10:11 AM
 */

class FBController extends BaseController {

    public function postSaveDetails()
    {
      $post = json_decode(file_get_contents("php://input"));
      Session::put('FBaccessToken', $post->accessToken);
      $response = Helper::VerifyFB($post->accessToken);
      if ($response->getGraphUser()) {
        $data = array(
          'fb_id' => $post->fb_id,
          'fb_url' => $post->fb_url,
          'first_name' => $post->first_name,
          'last_name' => $post->last_name,
          'email' => $post->email,
          'gender' => $post->gender,
        );
        User::saveFBDetails($data);
        $user_id = User::getUserIdByFbId($data['fb_id']);
        Auth::loginUsingId($user_id);
        if (UserBusiness::getBusinessIdByOwner($user_id)) {
          return json_encode(array('success' => $data['fb_id'], 'redirect' => '/business/my-business'));
        }
        else {
          return json_encode(array('success' => $data['fb_id'], 'redirect' => '/'));
        }
      }
      else {
        return json_encode(array('err' => 'FBVerifyError'));
      }
    }

    /*
     * author: CSD
     * @description: get page request with fb_id parameter
     */
    public function getFacebookUser() {
        $fb_id = $_GET['fb_id'];
        if (User::checkFBUser($fb_id)){
            return json_encode(array('success' => 1));
        } else {
            return json_encode(array('success' => 0));
        }
    }

    public function postLaravelLogin()
    {
        $post = json_decode(file_get_contents("php://input"));
        if (User::checkFBUser($post->fb_id) && !Auth::check()) {
            Auth::loginUsingId(User::getUserIdByFbId($post->fb_id));
            $success = 1;
        }
        else {
            $success = 0;
        }
        return json_encode(array('success' => $success));
    }

    public function postLaravelLogout()
    {
        Auth::logout();
    }

    public function getLaravelLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

}