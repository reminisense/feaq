<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/21/15
 * Time: 3:37 PM
 */

class AdminController extends BaseController{

    //temporary function to display user tracking data
    public function getStats($user_id){
        if(Admin::isAdmin()){
            return View::make('analytics.user_analytics')->with('user_id', $user_id);
        }else{
            return Redirect::to('/');
        }
    }

    public function getAddAdmin($email){
        if(Admin::isAdmin()){
            Admin::addAdmin($email);
            return json_encode(['success' => true]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getDeleteAdmin($email){
        if(Admin::isAdmin()){
            Admin::removeAdmin($email);
            return json_encode(['success' => true]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getAdmins(){
        if(Admin::isAdmin()){
            return json_encode(['success' => true, 'admins' => Admin::getAdmins()]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }
}