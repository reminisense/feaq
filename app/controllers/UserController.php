<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:12 PM
 */

class UserController extends BaseController{

    /*
     * @author: CSD
     * @description: verify user data page for first time fb login
     */
    public function postVerify(){
        $fb_id = Input::get('fb_id');
        if (User::checkFBUser($fb_id)){
            return Redirect::intended('/user/dashboard');
        } else {
            $user = [
                'first_name'    => Input::get('first_name'),
                'last_name'     => Input::get('last_name'),
                'email'         => Input::get('email'),
                'mobile'        => Input::get('mobile'),
                'location'      => Input::get('location'),
                'gender'        => Input::get('gender'),
                'fb_id'         => Input::get('fb_id'),
                'fb_url'        => Input::get('fb_url'),
            ];

            return View::make('user.verify')
                ->with('user', $user);
        }
    }

    /*
     * author: CSD
     * @description: store user data from verify user page
     */
    public function postStore(){
        $userData = Input::all();

        $user = new User();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->phone = $userData['mobile'];
        $user->local_address = $userData['location'];
        $user->sex = $userData['gender'];
        $user->fb_id = $userData['fb_id'];
        $user->fb_url = $userData['fb_url'];
        $user->save();

        return View::make('dashboard');
    }

    /*
     * author: CSD
     * @description: get dashboard page
     */
    public function getDashboard(){
        return View::make('dashboard');
    }
}