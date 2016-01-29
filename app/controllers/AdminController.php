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

  public function getBusinessDetails($business_id){
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $user = UserBusiness::getUserByBusinessId($business_id);
      return json_encode(array_merge(Business::getBusinessDetails($business_id), ['vanity_url' => Business::getVanityURLByBusinessId($business_id)],
          ['business_owner' => User::full_name($user->user_id)],['email_address' => User::email($user->user_id)]));
    }
    else {
      return json_encode(array('status' => 0, 'message', 'You are not allowed to access this function.'));
    }
  }

  public function postUpdateBusiness(){
    $business_data = Input::all();
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $business = Business::find($business_data['business_id']);

      if ($this->validateBusinessNameBusinessAddress($business, $business_data)) {
        $business->name = $business_data['business_name'];
        $business->local_address = $business_data['business_address'];
        $business->industry = $business_data['industry'];
        $business->fb_url = $business_data['facebook_url'];
        $business->timezone = $business_data['timezone']; //ARA Added timezone property

        $time_open_arr = Helper::parseTime($business_data['time_open']);
        $business->open_hour = $time_open_arr['hour'];
        $business->open_minute = $time_open_arr['min'];
        $business->open_ampm = $time_open_arr['ampm'];

        $time_close_arr = Helper::parseTime($business_data['time_close']);
        $business->close_hour = $time_close_arr['hour'];
        $business->close_minute = $time_close_arr['min'];
        $business->close_ampm = $time_close_arr['ampm'];

        $business->queue_limit = $business_data['queue_limit']; /* RDH Added queue_limit to Edit Business Page */
        $business->business_features = serialize($business_data['business_features']);
        $business->vanity_url = $business_data['vanity_url'];

        $business->save();

        //ARA For queue settings terminal-specific numbers
        $queue_settings = new QueueSettingsController();
        $queue_settings->getUpdate($business['business_id'], 'number_limit', $business_data['queue_limit']);
        $queue_settings->getUpdate($business['business_id'], 'terminal_specific_issue', $business_data['terminal_specific_issue']);
        $queue_settings->getUpdate($business['business_id'], 'sms_current_number', $business_data['sms_current_number']);
        $queue_settings->getUpdate($business['business_id'], 'sms_1_ahead', $business_data['sms_1_ahead']);
        $queue_settings->getUpdate($business['business_id'], 'sms_5_ahead', $business_data['sms_5_ahead']);
        $queue_settings->getUpdate($business['business_id'], 'sms_10_ahead', $business_data['sms_10_ahead']);
        $queue_settings->getUpdate($business['business_id'], 'sms_blank_ahead', $business_data['sms_blank_ahead']);
        $queue_settings->getUpdate($business['business_id'], 'input_sms_field', $business_data['input_sms_field']);
        $queue_settings->getUpdate($business['business_id'], 'allow_remote', $business_data['allow_remote']);
        $queue_settings->getUpdate($business['business_id'], 'remote_limit', $business_data['remote_limit']);

        //sms settings
        $sms_api_data = [];
        $sms_gateway_api = NULL;
        if($business_data['sms_gateway'] == 'frontline_sms'){
          $sms_api_data = [
            'frontline_sms_url' => $business_data['frontline_sms_url'],
            'frontline_sms_api_key' => $business_data['frontline_sms_api_key'],
          ];
          $sms_gateway_api = serialize($sms_api_data);
        }elseif($business_data['sms_gateway'] == 'twilio'){
          if($business_data['twilio_account_sid'] == TWILIO_ACCOUNT_SID &&
            $business_data['twilio_auth_token'] == TWILIO_AUTH_TOKEN &&
            $business_data['twilio_phone_number'] == TWILIO_PHONE_NUMBER){
            $business_data['sms_gateway'] = NULL;
            $sms_gateway_api = NULL;
          }else{
            $sms_api_data = [
              'twilio_account_sid' => $business_data['twilio_account_sid'],
              'twilio_auth_token' => $business_data['twilio_auth_token'],
              'twilio_phone_number' => $business_data['twilio_phone_number'],
            ];
            $sms_gateway_api = serialize($sms_api_data);
          }
        }
        $queue_settings->getUpdate($business['business_id'], 'sms_gateway', $business_data['sms_gateway']);
        $queue_settings->getUpdate($business['business_id'], 'sms_gateway_api', $sms_gateway_api);
        return json_encode(['success' => 1]);
      }
      else {
        return json_encode([
          'success' => 0,
          'error' => 'Business name already exists with the same business address.'
        ]);
      }
    }
    else {
      return json_encode([
        'success' => 0,
        'error' => 'You are not allowed to access this function.',
      ]);
    }
  }

  private function validateBusinessNameBusinessAddress($dbBusiness, $inputBusiness) {
    if ($dbBusiness->name != $inputBusiness['business_name'] || $dbBusiness->local_address != $inputBusiness['business_address']){
      $row = Business::businessExistsByNameByAddress($inputBusiness['business_name'], $inputBusiness['business_address']);
      if(count($row) == 0){
        return true;
      } else {
        return false;
      }
    } else {
      return true;
    }
  }

    public function postBusinessSearch() {
      return Business::getByLikeName(Input::get('keyword'));
    }

    public function postSaveVanity() {
      Business::saveVanityURL(Input::get('business_id'), Input::get('vanity_url'));
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