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
     * @description: check if user data is validated through verified user table row
     */
    public function getUserStatus()
    {
        $user = Auth::user();

        return json_encode([
            'success'   => 1,
            'user'      => $user,
        ]);
    }

    /*
     * @author: CSD
     * @description: verify data and update user details
     */
    public function postVerifyUser(){
        $userData = $_POST;

        $user = User::find($userData['user_id']);
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->phone = $userData['mobile'];
        $user->local_address = $userData['location'];
        $user->verified = 1;

        if ($user->save()){
            return json_encode([
                'success' => 1,
            ]);
        } else {
            return json_encode([
                'success' => 0,
            ]);
        }
    }

    /*
     * @author: CSD
     * @description: render dashboard, fetch all businesses for default search view, and businesses created by logged in user
     */
    public function getUserDashboard(){
        if (Auth::check())
        {
            $search_businesses = Business::all();
            $business_ids = UserBusiness::getAllBusinessIdByOwner(Auth::user()->user_id);

            $my_businesses = [];
            foreach($business_ids as $b_id)
            {
                array_push($my_businesses, Business::getBusinessArray($b_id->business_id));
            }

            return View::make('user.dashboard')
                ->with('search_businesses', $search_businesses)
                ->with('my_businesses', $my_businesses);
        }
        else
        {
            return View::make('page-front');
        }
    }
}