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
            $business_ids = UserBusiness::getAllBusinessIdByOwner(Helper::userId());

            $my_businesses = [];
            if (count($business_ids) > 0){
                foreach($business_ids as $b_id)
                {
                    array_push($my_businesses, Business::getBusinessArray($b_id->business_id));
                }
            }

            $my_terminals = TerminalUser::getTerminalAssignement(Auth::user()->user_id);
            if (count($my_terminals) > 0){
                foreach($my_terminals as $terminal){
                    $b_id = Business::getBusinessIdByTerminalId($terminal['terminal_id']);
                    $business = Business::getBusinessArray($b_id);
                    if (!$this->inArrayBusiness($my_businesses, $business)){
                        array_push($my_businesses, $business);
                    }
                }
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

    private function inArrayBusiness($businesses, $business){
        foreach($businesses as $haystack){
            if ($haystack->business_id == $business->business_id){
                return true;
            }
        }

        return false;
    }

    public function getUserlist(){
        $users = User::getAllUsers();
        return json_encode(['success' => 1 , 'users' => $users]);
    }
}