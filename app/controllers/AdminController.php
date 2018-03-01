<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/21/15
 * Time: 3:37 PM
 */

use utils\RandomStringGenerator;

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

  public function postCreateBusiness()
  {
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $business_data = Input::all();
      $business = new Business();
      $business_check = Business::businessExistsByNameByAddress($business_data['business_name'], $business_data['business_address']);

      if (count($business_check) != 1) {
        $business->name = $business_data['business_name'];
        $business->local_address = $business_data['business_address'];
        $business->industry = $business_data['industry'];

        $geolocation = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(" ", "+", $business_data['business_address'])));
        $business->longitude = $geolocation->results[0]->geometry->location->lng;
        $business->latitude = $geolocation->results[0]->geometry->location->lat;

        $time_open_arr = Helper::parseTime($business_data['time_open']);
        $business->open_hour = $time_open_arr['hour'];
        $business->open_minute = $time_open_arr['min'];
        $business->open_ampm = $time_open_arr['ampm'];

        $time_close_arr = Helper::parseTime($business_data['time_close']);
        $business->close_hour = $time_close_arr['hour'];
        $business->close_minute = $time_close_arr['min'];
        $business->close_ampm = $time_close_arr['ampm'];

        $business->fb_url = '';
        $business->business_features = '';
        $business->queue_limit = 9999;
        $business->num_terminals = 1;
        $business->raw_code = Helper::generateRawCode(); // Generate business raw code for broadcast redirect

        $business_features = array(
          'package_type' => 'Trial',
          'max_services' => 3,
          'max_terminals' => 3,
          'enable_video_ads' => 0,
          'upload_size_limit' => 0,
        );
        $business->business_features = serialize($business_features);
        $business->save();
        Helper::dbLogger('AdminController', 'business', 'insert', 'postCreateBusiness', User::email(Helper::userId()), 'business_id:' . $business->business_id . ', business_name:' . $business->name);

        $business_user = new UserBusiness();
        $business_user->user_id = User::getUserIdByEmail($business_data['email']);
        $business_user->business_id = $business->business_id;
        $business->timezone = $business_data['timezone'];

        /* Timezone is already set in config/app.php
        date_default_timezone_set("Asia/Manila"); // Manila Timezone for now but this depends on business location
        */

        $contents = '
                {
                  "box1": {
                    "number": "1",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "box2": {
                    "number": "2",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "box3": {
                    "number": "3",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "box4": {
                    "number": "4",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "box5": {
                    "number": "5",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "box6": {
                    "number": "6",
                    "terminal": "",
                    "rank": "",
                    "service": ""
                  },
                  "get_num": " ",
                  "display": "1-6",
                  "show_issued": true,
                  "ad_image": "",
                  "ad_video": "\/\/www.youtube.com\/embed\/EMnDdH8fdEc",
                  "ad_type": "carousel",
                  "carousel_delay": "5000",
                  "turn_on_tv": false,
                  "tv_channel": "",
                  "date": "' . date("mdy") . '",
                  "ticker_message" : "",
                  "ticker_message2" : "",
                  "ticker_message3" : "",
                  "ticker_message4" : "",
                  "ticker_message5" : "",
                  "adspace_size" : "517px",
                  "numspace_size": "517px",
                  "num_boxes" : "6",
                  "show_qr_setting": "yes"
                }
            ';

        File::put(public_path() . '/json/' . $business->business_id . '.json', $contents);
        $business_user->save();
        Helper::dbLogger('AdminController', 'user_business', 'insert', 'postCreateBusiness', User::email(Helper::userId()), 'owner:' . $business_data['email'] . ', business_name:' . $business->name);

        $branch_id = Branch::createBusinessBranch($business->business_id, $business->name);
        $service_id = Service::createBranchService($branch_id, $business->name);

        /* @CSD Auto issue on business create */
        $issueController = new IssueNumberController();
        $issueController->getMultiple($service_id, 10);
        /* Auto issue end */

        $terminals = Terminal::createBranchServiceTerminal($business_user->user_id, $service_id, $business->num_terminals);


        if($business_data['suggested']){
            $business_list = BusinessList::find(BusinessList::getBusinessListIdByName($business_data['business_name'])->business_list_id);
            $business_list->name = $business_data['business_name'];
            $business_list->local_address = $business_data['business_address'];
            $business_list->email = '';
            $business_list->time_open = $business_data['time_open'];
            $business_list->time_close = $business_data['time_close'];
            $business_list->phone = 0;
            $business_list->business_id = Business::getBusinessIdByName($business_data['business_name'])[0]['business_id'];
            $business_list->created_by = Helper::userId();
            $business_list->save();
        }


        if ($business->save()) {
          return json_encode([
            'success' => 1,
            'terminals' => $terminals
          ]);
        }
        else {
          return json_encode([
            'success' => 0,
            'error' => 'Something went wrong while saving your business.'
          ]);
        }
      }
      else {
        $error = "Business name already exists with the same business address.";
        return json_encode([
          'success' => 0,
          'error' => $error
        ]);
      }
    }
    else {
      return json_encode(array('success' => 0, 'error' => 'You are not allowed to access this function or you already have a business account.'));
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
        Helper::dbLogger('AdminController', 'business', 'update', 'postEditBusiness', User::email(Helper::userId()), 'business_id:' . $business->business_id . ', business_name:' . $business->name);

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

    public function getBusinessListDetails($business_list_id){
        if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
            return json_encode(BusinessList::getBusinessListDetails($business_list_id));
        }
        else {
            return json_encode(array('status' => 0, 'message', 'You are not allowed to access this function.'));
        }
    }

    public function postBusinessListSearch() {
        return BusinessList::getBusinessListByLikeName(Input::get('keyword'));
    }


    public function postUpdateBusinessList(){

        if (Auth::check() && Admin::isAdmin(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = BusinessList::find($business_list_data['business_list_id']);

            $business_list->name = $business_list_data['name'];
            $business_list->local_address = $business_list_data['local_address'];
            $business_list->email = $business_list_data['email'];
            $business_list->time_open = $business_list_data['time_open'];
            $business_list->time_close = $business_list_data['time_close'];
            $business_list->phone = $business_list_data['phone'];
            $business_list->created_by = Helper::userId();


            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while saving your business.'
                ]);
            }
        }else{
            return json_encode([
                'success' => 0,
                'error' => 'You are not allowed to access this function.'
            ]);
        }
    }

    public function postCreateBusinessList(){

        if (Auth::check() && Admin::isAdmin(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = new BusinessList();

            $business_list->name = $business_list_data['name'];
            $business_list->local_address = $business_list_data['local_address'];
            $business_list->email = $business_list_data['email'];
            $business_list->time_open = $business_list_data['time_open'];
            $business_list->time_close = $business_list_data['time_close'];
            $business_list->phone = $business_list_data['phone'];
            $business_list->business_id = null;
            $business_list->created_by = Helper::userId();


            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while saving your business.'
                ]);
            }
        }
    }

    public function postRemoveBusinessList(){

        if (Auth::check() && Admin::isAdmin(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = BusinessList::find($business_list_data['business_list_id']);

            $business_list->deleted_at = date('Y-m-d G:i:s');

            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while deleting your business.'
                ]);
            }
        }
    }

    public function postRestoreBusinessList(){

        if (Auth::check() && Admin::isAdmin(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = BusinessList::find($business_list_data['business_list_id']);

            $business_list->deleted_at = mktime(0,0,0,0,0,0);

            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while restoring your business.'
                ]);
            }
        }
    }

    public function postSpreadsheetBusinessList(){

        $target_dir = public_path()."/files/";
        $target_file = $target_dir. basename($_FILES["business_list"]["name"]);

        if(move_uploaded_file($_FILES["business_list"]["tmp_name"], $target_file)) {

            $business_list_data = BusinessList::all();

            $inputFileType = PHPExcel_IOFactory::identify($target_file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($target_file);

            $sheet = $objPHPExcel->getSheet(0);
            $highest_row = $sheet->getHighestRow();
            $highest_column = $sheet->getHighestColumn();
            $business_name_column = 0;
            $name_index = 0;
            $local_address_index = 1;
            $email_index = 2;
            $phone_index = 3;
            $time_open_index = 4;
            $time_close_index = 5;

            $new_business_list = array();
            $updated_business_list = array();

            for ($row = 1; $row <= $highest_row; $row++) {
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row,NULL,TRUE,FALSE);

                $business_name_input = preg_replace('/[^a-z]/', "", strtolower($rowData[$name_index][$business_name_column]));

                foreach($business_list_data as $key=>$business){
                    $business_list_name = preg_replace('/[^a-z]/', "", strtolower($business['name']));
                    if($business_list_name === $business_name_input){
                        array_push($updated_business_list,
                            [
                                'business_list_id' => $business['business_list_id'],
                                'name' => $rowData[$business_name_column][$name_index],
                                'local_address' => $rowData[$business_name_column][$local_address_index],
                                'email' => $rowData[$business_name_column][$email_index],
                                'phone' => $rowData[$business_name_column][$phone_index],
                                'time_open' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_open_index],'h:i a'))),
                                'time_close' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_close_index],'h:i')))
                            ]
                        );
                        break;
                    }
                    if( $key+1 == count($business_list_data)){
                        if($rowData){

                            array_push($new_business_list, [
                                'name' => $rowData[$business_name_column][$name_index],
                                'local_address' => $rowData[$business_name_column][$local_address_index],
                                'email' => $rowData[$business_name_column][$email_index],
                                'phone' => $rowData[$business_name_column][$phone_index],
                                'time_open' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_open_index],'h:i a'))),
                                'time_close' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_close_index],'h:i'))),
                                'business_id' => null,
                                'created_by' => Helper::userId()
                            ]);
                        }
                    }
                }
            };

            if(BusinessList::updateListByBatch($updated_business_list) && $new_business_list ? BusinessList::insert($new_business_list):true){
                return json_encode(['success' => 1]);
            }else{
                return json_encode(['success' => 0, 'error_message' =>'Something went wrong..']);
            }
        }else{
            return json_encode(['success' => 0, 'error_message' =>'Something went wrong..']);
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

  public function getUserDetails($user_id) {
    if (Admin::isAdmin(Helper::userId())) {
      return json_encode(array_merge(User::getUserByUserId($user_id), array(
        'status' => User::getStatusByUserId($user_id),
        'address' => User::local_address($user_id),
      )));
    }
    return json_encode(array('status' => 0));
  }

  /**
   * Register without using fb
   * Taken from UserController->postEmailRegistration()
   *
   */
  public function postCreateUser(){

    if (Admin::isAdmin(Helper::userId())) {
      $email = Input::get('email');
      $password = Input::get('password');
      $password_confirm = Input::get('password_confirm');


      if (
        isset($email) && $email != "" &&
        isset($password) && $password != "" &&
        isset($password_confirm) && $password_confirm != ""
      ) {

        if ($password != $password_confirm) {
          return json_encode(['error' => "Passwords do not match."]);
        }

          if(User::where('email', '=', $email)->first()){
              return json_encode(['error' => "Email already exists."]);
          }


        $user = [
          'email' => $email,
          'password' => Hash::make($password),
          'gcm_token' => '',
        ];

        User::insert($user);
        Helper::dbLogger('AdminController', 'user', 'insert', 'postCreateUser', User::email(Helper::userId()), 'email:' . $email);

        try {
          Notifier::sendConfirmationEmail($email);
          return json_encode(['success' => 1]);
        } catch (Exception $e) {
          return json_encode([
            'success' => 1
          ]);
        }
      }
      else {
        return json_encode(['error' => "There are missing parameters."]);
      }
    }
    else {
      return json_encode(array('status' => 0, 'message' => 'You are not allowed to access this function.'));
    }

  }

  public function postUpdateUser(){
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $user = User::find(Input::get('user_id'));
      $user->first_name = Input::get('edit_first_name');
      $user->last_name = Input::get('edit_last_name');
      $user->phone = Input::get('edit_mobile');
      $user->local_address = Input::get('edit_user_location');
      $user->status = Input::get('edit_status');
      $user->email = Input::get('edit_email');

      if ($user->save()) {
        Helper::dbLogger('AdminController', 'user', 'update', 'postUpdateUser', User::email(Helper::userId()), 'email:' . $user->email . ',user_id:' . Input::get('user_id'));
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

  public function postResetPassword() {
    if (Admin::isAdmin(Helper::userId())) { // PAG added permission checking
      $new_pass = \RandomStringGenerator::generate(8);
      $user = User::find(Input::get('user_id'));
      $user->password = Hash::make($new_pass);
      $user->save();
      Helper::dbLogger('AdminController', 'user', 'update', 'postResetPassword', User::email(Helper::userId()), 'user_id:' . Input::get('user_id'));
      return json_encode(array('password' => $new_pass));
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
          'allow_sms' => 'false',
          'queue_forwarding' => 'false'
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

    public function getMigrateTransactions() {
      $res = DB::table('terminal_transaction')->join('priority_queue', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')->join('priority_number', 'priority_queue.track_id', '=', 'priority_number.track_id')->select(array(
        'terminal_transaction.transaction_number','terminal_transaction.time_completed', 'terminal_transaction.time_queued', 'terminal_transaction.time_called', 'terminal_transaction.terminal_id', 'terminal_transaction.time_assigned', 'priority_queue.priority_number', 'priority_queue.confirmation_code', 'priority_queue.user_id', 'priority_queue.queue_platform', 'priority_queue.name', 'priority_queue.phone', 'priority_number.date', 'priority_number.service_id', 'priority_number.last_number_given', 'priority_number.current_number',
      ))->get();

      foreach ($res as $count => $data) {
        QueueTransaction::insert(array(
          'transaction_number' => $data->transaction_number,
          'time_completed' => $data->time_completed,
          'time_queued' => $data->time_queued,
          'time_called' => $data->time_called,
          'terminal_id' => $data->terminal_id,
          'time_assigned' => $data->time_assigned,
          'priority_number' => $data->priority_number,
          'confirmation_code' => $data->confirmation_code,
          'user_id' => $data->user_id,
          'queue_platform' => $data->queue_platform,
          'name' => $data->name,
          'phone' => $data->phone,
          'date' => $data->date,
          'service_id' => $data->service_id,
          'last_number_given' => $data->last_number_given,
          'current_number' => $data->current_number,
        ));
      }

      echo 'data migrated';
    }

  public function getDefaultColors() {
    $colors = array('', 'blue', 'borange', 'violet', 'green', 'red', 'yellow', 'cyan');
    $terminals = Terminal::all();
    echo '<pre>';
    foreach ($terminals as $count => $data) {
      Terminal::where('terminal_id', '=', $data->terminal_id)->update(array('color' => $colors[$data->box_rank]));
    }
    echo 'default colors set.';
  }
}