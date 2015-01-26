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
        $data = array(
            'fb_id' => $_POST['fb_id'],
            'fb_url' => $_POST['fb_url'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
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