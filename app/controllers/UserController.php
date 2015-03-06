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
     * @description: update user profile details
     */
    public function postUpdateUser(){
        $userData = $_POST;

        $user = User::find($userData['user_id']);
        $user->first_name = $userData['edit_first_name'];
        $user->last_name = $userData['edit_last_name'];
        $user->phone = $userData['edit_mobile'];
        $user->local_address = $userData['edit_user_location'];

        if ($user->save()){
            return json_encode([
                'success' => 1,
            ]);
        } else {
            return json_encode([
                'success' => 0,
                'error' => 'Something went wrong while trying to save your profile.'
            ]);
        }
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
        $search_businesses_front = Business::orderBy('business_id', 'desc')
                                ->take(4)
                                ->get(); // RDH Changed implementation to only include newest 4 businesses

        $active_businesses_front = Business::getActiveBusinesses();
        $active_businesses_front = array_slice($active_businesses_front, 0, 4, true); // RDH Implemented to only show maximum 4 businesses


        $search_businesses = Business::all();
        $active_businesses = Business::getActiveBusinesses();

        if (Auth::check())
        {
            $business_ids = UserBusiness::getAllBusinessIdByOwner(Helper::userId());
            $my_businesses = [];
            if (count($business_ids) > 0){
                foreach($business_ids as $b_id)
                {
                    $temp_array = Business::getBusinessArray($b_id->business_id);
                    $temp_array->owner = 1;
                    array_push($my_businesses, $temp_array);
                }
            }

            $my_terminals = TerminalUser::getTerminalAssignement(Auth::user()->user_id);
            if (count($my_terminals) > 0){
                foreach($my_terminals as $terminal){
                    $b_id = Business::getBusinessIdByTerminalId($terminal['terminal_id']);
                    $business = Business::getBusinessArray($b_id);
                    if (!$this->inArrayBusiness($my_businesses, $business)){
                        $business->owner = 0;
                        array_push($my_businesses, $business);
                    }
                }
            }

            return View::make('user.dashboard')
                ->with('active_businesses', $active_businesses)
                ->with('search_businesses', $search_businesses)
                ->with('my_businesses', $my_businesses);
        }
        else
        {
            return View::make('page-front')
                ->with('active_businesses', $active_businesses_front)
                ->with('search_businesses', $search_businesses_front); // RDH Active and New Businesses on Front Use Different Results
        }
    }

    public function processContactForm(){
        $data = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'messageContent' => Input::get('message')
        ];
        Mail::send('emails.contact', $data, function($message)
        {
            $message->subject('Inquiry at FeatherQ'); // RDH Changed to correct spelling "Inquiry"
            $message->to('admin@reminisense.com');
        });

        Mail::send('emails.contact_confirmation', $data, function($message)
        {
            $message->subject('Confirmation Message from FeatherQ');
            $message->to(Input::get('email'));
        });

        return Redirect::to('/#contact')
            ->with('message', 'Email successfully sent!');
    }

    private function inArrayBusiness($businesses, $business){
        foreach($businesses as $haystack){
            if ($haystack->business_id == $business->business_id){
                return true;
            }
        }

        return false;
    }

//    removed due to new implementation of assigning users
//    public function getUserlist(){
//        $users = User::getAllUsers();
//        return json_encode(['success' => 1 , 'users' => $users]);
//    }

    public function getEmailsearch($email){
        $user = User::searchByEmail($email);
        return json_encode(['success' => 1, 'user' => $user]);
    }
}