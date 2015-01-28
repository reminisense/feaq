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

    public function postLaravelLogout()
    {
        Auth::logout();
    }

    public function getSaveDetails()
    {
        return 'dasdasa';
    }

}