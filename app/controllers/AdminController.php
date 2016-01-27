<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/21/15
 * Time: 3:37 PM
 */

class AdminController extends BaseController{

    public function getDashboard(){
        if(Admin::isAdmin()){
            return View::make('admin.admin-dashboard');
        }else{
            return Redirect::to('/');
        }
    }

    //temporary function to display user tracking data
    public function getStats(){
        if(Admin::isAdmin()){
            return View::make('analytics.user_analytics');
        }else{
            return Redirect::to('/');
        }
    }

    public function getBusiness(){
        if(Admin::isAdmin()){
            return View::make('admin.business-dashboard');
        }else{
            return Redirect::to('/');
        }
    }

    public function postBusinessSearch() {
      return Business::getByLikeName(Input::get('keyword'));
    }

    public function getVanityUrl($business_id) {
      return json_encode(array('vanity_url' => Business::getVanityURLByBusinessId($business_id)));
    }

    public function postSaveVanity() {
      Business::saveVanityURL(Input::get('business_id'), Input::get('vanity_url'));
    }

  public function getUserDetails($user_id) {
    if (Admin::isAdmin(Helper::userId())) {
      return json_encode(array_merge(User::getUserByUserId($user_id), array(
        'status' => User::getStatusByUserId($user_id),
        'address' => User::local_address($user_id),
      )));
    }
    return json_encode(array('status' => 0));
  }

  public function postUpdateUser(){
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $user = User::find(Input::get('user_id'));
      $user->first_name = Input::get('edit_first_name');
      $user->last_name = Input::get('edit_last_name');
      $user->phone = Input::get('edit_mobile');
      $user->local_address = Input::get('edit_user_location');
      $user->status = Input::get('status');

      if ($user->save()) {
        return json_encode([
          'success' => 1,
        ]);
      }
      else {
        return json_encode([
          'success' => 0,
          'error' => 'Something went wrong while trying to save your profile.'
        ]);
      }
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

    public function getUser(){
      if(Admin::isAdmin()){
        return View::make('admin.user-dashboard')
          ->with('users', User::all());
      }else{
        return Redirect::to('/');
      }
    }

    public function getInitializeBusinessfeatures() {
      $res = Business::all();
      foreach ($res as $count => $business) {
        $business_id = $business->business_id;
        Business::saveBusinessFeatures($business_id, [
          'package_type' => 'Trial',
          'max_services' => "3",
          'max_terminals' => "3",
          'enable_video_ads' => "0",
          'upload_size_limit' => "10",
        ]);
      }
      echo 'done..';
    }

    public function getNumbers(){
        if(Admin::isAdmin()){
            return View::make('analytics.user_numbers');
        }else{
            return Redirect::to('/');
        }
    }

    public function getShowgraph($start_date, $end_date, $mode, $value){
        if(Admin::isAdmin()){
            return View::make('admin.business-graph')->with('start_date', $start_date)
                ->with('end_date', $end_date)->with('mode', $mode)->with('value', $value);
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

    public function getBusinessnumbers($start_date, $end_date){
      if (Admin::isAdmin()) { // PAG added permission checking

        $businesses_count = 0;
        $users_count = 0;
        $users_information = [];
        $businesses_information = [];
        $temp_date = $end_date + 86400;

        $businesses = Business::getBusinessByRange($start_date, $temp_date);
        if($businesses){
            $businesses_count = count($businesses);
            for($i = 0; $i < $businesses_count; $i++){
                $user = UserBusiness::getUserByBusinessId($businesses[$i]->business_id);
                array_push($businesses_information,
                    [
                        'business_name'=> $businesses[$i]->name,
                        'name' => User::full_name($user->user_id),
                        'email' => User::email($user->user_id),
                        'phone' =>User::phone($user->user_id)
                    ]
                );
            }
        }
        $users = User::getUsersByRange($start_date, $temp_date);
        if($users){
            $users_count = count($users);
            for($i = 0; $i < $users_count; $i++){
                array_push($users_information,
                    [
                        'first_name'=> $users[$i]->first_name,
                        'last_name' => $users[$i]->last_name,
                        'email' => $users[$i]->email,
                        'phone' =>$users[$i]->phone
                    ]
                );
            }
          }

        $business_numbers = [
            'issued_numbers'=>Analytics::countBusinessNumbers($start_date, $end_date, 0),
            'called_numbers'=>Analytics::countBusinessNumbers($start_date, $end_date, 1),
            'served_numbers'=>Analytics::countBusinessNumbers($start_date, $end_date, 2),
            'dropped_numbers'=>Analytics::countBusinessNumbers($start_date, $end_date, 3)
        ];


          return json_encode(array(
          'success' => 1,
          'businesses_count' => $businesses_count,
          'businesses_information' => $businesses_information,
          'users_count' => $users_count,
          'users_information' => $users_information,
          'business_numbers' => $business_numbers
        ));
      }
      else {
        return json_encode(array('success' => 0, 'message' => 'You are not allowed to access this function.'));
      }
    }

    public function getAllbusinesses(){
      if (Admin::isAdmin()) { // PAG added permission checking
        $businesses = Business::getAllBusinessNames();
        return json_encode(['success' => 1, 'businesses' => $businesses]);
      }
      else {
        return json_encode(array('success' => 0, 'message' => 'You are not allowed to access this function.'));
      }
    }

    public function getProcessnumbers($start_date, $end_date, $mode, $value){
      if (Admin::isAdmin()) { // PAG added permission checking
        $temp_start_date = $start_date;
        $temp_end_date = $end_date + 86400;

        if ($mode == "business") {

          $issued_numbers = [];
          $called_numbers = [];
          $served_numbers = [];
          $dropped_numbers = [];
          $issued_data_numbers = [];

          $business = Business::getBusinessIdByName($value);
          while ($temp_start_date < $temp_end_date) {

            $next_day = $temp_start_date + 86400;

            for ($i = 0; $i < count($business); $i++) {


              $issued_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, 0);
              $called_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, 1);
              $served_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, 2);
              $dropped_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, 3);
              $issued_data_count = Analytics::countNumbersWithData($business[$i]->business_id, $temp_start_date);

              array_push($issued_numbers, $issued_count);
              array_push($called_numbers, $called_count);
              array_push($served_numbers, $served_count);
              array_push($dropped_numbers, $dropped_count);
              array_push($issued_data_numbers, $issued_data_count);

            }

            $temp_start_date = $next_day;
          }

          return json_encode([
            'success' => 1,
            'issued_numbers' => $issued_numbers,
            'called_numbers' => $called_numbers,
            'served_numbers' => $served_numbers,
            'dropped_numbers' => $dropped_numbers,
            'issued_numbers_data' => $issued_data_numbers
          ]);

        }
        else {
          if ($mode == "industry") {

            $business_id = Business::getBusinessIdsByIndustry($value);

            $issued_numbers = [];
            $called_numbers = [];
            $served_numbers = [];
            $dropped_numbers = [];
            $issued_data_numbers = [];

            while ($temp_start_date < $temp_end_date) {

              $next_day = $temp_start_date + 86400;

              $issued_count = Analytics::countNumbersByIndustry($business_id, $temp_start_date, 0);
              $called_count = Analytics::countNumbersByIndustry($business_id, $temp_start_date, 1);
              $served_count = Analytics::countNumbersByIndustry($business_id, $temp_start_date, 2);
              $dropped_count = Analytics::countNumbersByIndustry($business_id, $temp_start_date, 3);
              $issued_data_count = Analytics::countIndustryNumbersWithData($business_id, $temp_start_date);

              array_push($issued_numbers, $issued_count);
              array_push($called_numbers, $called_count);
              array_push($served_numbers, $served_count);
              array_push($dropped_numbers, $dropped_count);
              array_push($issued_data_numbers, $issued_data_count);

              $temp_start_date = $next_day;
            }

            return json_encode([
              'success' => 1,
              'issued_numbers' => $issued_numbers,
              'called_numbers' => $called_numbers,
              'served_numbers' => $served_numbers,
              'dropped_numbers' => $dropped_numbers,
              'issued_numbers_data' => $issued_data_numbers
            ]);

          }
          else {
            if ($mode == "country") {

              $business_id = Business::getBusinessIdsByCountry($value);

              $issued_numbers = [];
              $called_numbers = [];
              $served_numbers = [];
              $dropped_numbers = [];
              $issued_data_numbers = [];

              while ($temp_start_date < $temp_end_date) {

                $next_day = $temp_start_date + 86400;

                $issued_count = Analytics::countNumbersByCountry($business_id, $temp_start_date, 0);
                $called_count = Analytics::countNumbersByCountry($business_id, $temp_start_date, 1);
                $served_count = Analytics::countNumbersByCountry($business_id, $temp_start_date, 2);
                $dropped_count = Analytics::countNumbersByCountry($business_id, $temp_start_date, 3);
                $issued_data_count = Analytics::countCountryNumbersWithData($business_id, $temp_start_date);

                array_push($issued_numbers, $issued_count);
                array_push($called_numbers, $called_count);
                array_push($served_numbers, $served_count);
                array_push($dropped_numbers, $dropped_count);
                array_push($issued_data_numbers, $issued_data_count);

                $temp_start_date = $next_day;
              }

              return json_encode([
                'success' => 1,
                'issued_numbers' => $issued_numbers,
                'called_numbers' => $called_numbers,
                'served_numbers' => $served_numbers,
                'dropped_numbers' => $dropped_numbers,
                'issued_numbers_data' => $issued_data_numbers
              ]);
            }
          }
        }
      }
      else {
        return json_encode(array('success' => 0, 'message' => 'You are not allowed to access this function.'));
      }
    }

    public function postSaveFeatures($business_id){
      if (Admin::isAdmin()) { // PAG added permission checking
        $data = Input::all();
        Business::saveBusinessFeatures($business_id, $data);
      }
      else {
        return json_encode(array('success' => 0, 'message' => 'You are not allowed to access this function.'));
      }
    }

    public function getBusinessFeatures($business_id){
      if (Admin::isAdmin()) { // PAG added permission checking
        return json_encode(['features' => Business::getBusinessFeatures($business_id)]);
      }
      else {
        return json_encode(array('success' => 0, 'message' => 'You are not allowed to access this function.'));
      }
    }

    public function getTest($business_id){
        return Business::getBusinessAccessKey($business_id);
    }
}