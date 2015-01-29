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
        $user = [
            'first_name'    => Input::get('first_name'),
            'last_name'     => Input::get('last_name'),
            'email'         => Input::get('email'),
            'mobile'        => Input::get('mobile'),
            'location'      => Input::get('location'),
        ];

        // $user find user by fb id
        // update user details based on validation form
        // return json response
    }

    /*
     * author: CSD
     * @description: get dashboard page
     */
    public function getDashboard(){
        return View::make('dashboard');
    }
}