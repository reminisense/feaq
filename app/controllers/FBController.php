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

      // Call Facebook and let them verify if the information sent by the user
      // is the same with the ones in their database.
      // This will save us from the exploit of a post request with bogus details
      $fb = new Facebook\Facebook([
        'app_id' => '1577295149183234',
        'app_secret' => '23a15a243f7ce66a648ec6c48fa6bee9',
        'default_graph_version' => 'v2.4',
      ]);
      try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me', $post->accessToken); // Use the access token retrieved by JS login
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        return json_encode(array('message' => $e->getMessage()));
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        return json_encode(array('message' => $e->getMessage()));
      }

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
        Auth::loginUsingId(User::getUserIdByFbId($data['fb_id']));
        return json_encode(array('success' => $data['fb_id']));
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

    public function getSaveDetails()
    {
        return 'dasdasa';
    }

}