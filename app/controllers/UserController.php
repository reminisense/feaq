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
      return json_encode(array('success'   => 1, 'user' => Auth::user()));
    }

    /*
     * @author: CSD
     * @description: update user profile details
     */
    public function postUpdateUser(){
        $userData = $_POST;
      if (Auth::check() && Helper::userId() == $userData['user_id']) { // PAG added permission checking
        $user = User::find($userData['user_id']);
        $user->first_name = $userData['edit_first_name'];
        $user->last_name = $userData['edit_last_name'];
        $user->phone = $userData['edit_mobile'];
        $user->local_address = $userData['edit_user_location'];

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

    /*
     * @author: CSD
     * @description: verify data and update user details
     */
    public function postVerifyUser(){
        $userData = Input::all();
      if (Auth::check() && Helper::userId() == $userData['user_id']) { // PAG added permission checking
        $user = User::find($userData['user_id']);
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->email = $userData['email'];
        $user->phone = $userData['mobile'];
        $user->local_address = $userData['location'];
        $user->verified = 1;

        if ($user->save()) {
          return json_encode([
            'success' => 1,
          ]);
        }
        else {
          return json_encode([
            'success' => 0,
          ]);
        }

      } else if($user = User::where('email', '=', $userData['email'])->first()) {
          $user->first_name = $userData['first_name'];
          $user->last_name = $userData['last_name'];
          $user->email = $userData['email'];
          $user->phone = $userData['mobile'];
          $user->local_address = $userData['location'];
          $user->verified = 1;

          if ($user->save()) {
              Auth::loginUsingId($user->user_id);
              return json_encode(['success' => 1,]);
          }
          else {
              return json_encode(['success' => 0,]);
          }

      }else{
        return json_encode(array('message' => 'You are not allowed to access this function.'));
      }
    }

    /*
     * @author: CSD
     * @description: render dashboard, fetch all businesses for default search view, and businesses created by logged in user
     */
    public function getUserDashboard($raw_code = false){

        // Check if the user is accessing a custom URL; redirect if yes, skip if no
      if (!empty($raw_code)) {
        $broadcast = new BroadcastController();
        return $broadcast->viewBroadcastPage($raw_code);
      }

        if (Auth::check()) {
          return View::make('user.dashboardnew');
        }
        else {
          return View::make('user.user-landing');
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
        return $user ? json_encode(['success' => 1, 'user' => $user]) : json_encode(['success' => 0, 'error' => 'User does not exist in FeatherQ.']);
    }

    public function getUserByEmail($email){
        $user = User::searchByEmail($email);

        return json_encode(array_merge($user, array(
            'status' =>  $user ? User::getStatusByUserId($user['user_id']) : null,
            'address' => $user ? User::local_address($user['user_id']) : null,
            'phone' => $user ? User::phone($user['user_id']) : null
        )));
    }

    /**
     * @author Ruffy Heredia
     * @description Get User by Facebook ID
     */
    public function getFacebookIdSearch($fb_id) {
        $user = User::searchByFacebookId($fb_id);
        return json_encode(['success' => 1, 'user' => $user]);
    }

    /**
     * @author Ruffy Heredia
     * @description Get GCM token of user based on Facebook ID
     */
    public function getGcmToken($fb_id) {
        $user = User::getGcmByFacebookId($fb_id);
        return json_encode(['success' => 1, 'user' => $user]);
    }

    /**
     * @author Carl Dalid
     * @description Check if FB ID exist, if true update GCM Token
     */
    public function getUpdateGcmToken($fb_id, $gcm){
        $user = User::checkFBUser($fb_id);
        if($user){
            User::updateGCMToken($fb_id, $gcm);
            return json_encode(['success' => 1, 'user' => $user]);
        } else {
            return json_encode(['success' => 0]);
        }
    }

    /**
     * @author: Carl Dalid
     * @description: Get User by User ID for remote queue
     */
    public function getRemoteuser($user_id){
        $user = User::where('user_id', '=', $user_id)->first();
        if($user){
            $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $user_queue = User::getUserHistory($user->user_id, 99, 0, $date);
            if($user_queue){
                $queue_status = $user_queue[0]['date'] == $date && $user_queue[0]['time_called'] == 0 ? 0 : 1;
            }else{
                $queue_status = 1;
            }
            return json_encode(
                array(
                    'status' => '1',
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'queue_status' => $queue_status,
                    'user_queue' => $queue_status ? null : $user_queue[0],
                )
            );
        } else {
            return json_encode(array('status' => '0'));
        }
    }

    public function getSearchUser($keyword){
        $users = User::searchByKeyword($keyword);
        return json_encode(['success' => 1, 'users' => $users]);
    }


    /**
     * Register without using fb
     *
     */
    public function postEmailRegistration(){

        $email = Input::get('email');
        $password = Input::get('password');
        $password_confirm = Input::get('password_confirm');


        if(
            isset($email) && $email != "" &&
            isset($password) && $password != "" &&
            isset($password_confirm) && $password_confirm != ""
        ){

            if($password != $password_confirm){
                return json_encode(['error' => "Passwords do not match."]);
            }

            if(User::where('email', '=', $email)->first()){
                return json_encode(['error' => "Email already exists."]);
            }

            $user = [
                'first_name' => '',
                'last_name' => '',
                'email' => $email,
                'password' => Hash::make($password),
                'gcm_token' => '',
            ];

            User::insert($user);
            try{
                Notifier::sendConfirmationEmail($email);
                return json_encode(['success' => 1, 'redirect' => '/user/login', 'message' => 'Your account has been created please check your email to confirm your registration.']);
            }catch(Exception $e){
                return json_encode(['success' => 1, 'redirect' => '/user/verify-email/' . $email]);
            }
        }else{
            return json_encode(['error' => "There are missing parameters."]);
        }


    }

    /**
     * login without using fb
     *
     */
    public function postEmailLogin(){
        $email = Input::get('email');
        $password = Input::get('password');

        if(isset($email) && $email != "" && isset($password) && $password != ""){
            $user = User::where('email', '=', $email)->first();
            if($user && !$user->verified){
                return json_encode(['error' => 1, 'resend' => 1]);
            }else if($user && $user->password == '' && $user->fb_id != ''){
                return json_encode(['error' => 'Email is connected to a Facebook account. Please login with Facebook.']);
            }else if($user && Hash::check($password, $user->password)){
                Session::put('FBaccessToken', null);
                Auth::loginUsingId($user->user_id);
                return json_encode(array('success' => 1, 'redirect' => '/business'));
            }else{
                return json_encode(['error' => 'The email or password is incorrect.']);
            }
        }else{
            return json_encode(['error' => 'The email or password should not be blank.']);
        }
    }

    public function getLogin(){
        if(Auth::check()){
            return Redirect::to('/');
        }else{
            return View::make('user.email-login');
        }
    }

/* ARA - FQW-218 Removed to separate business and user registration*/
//    public function getRegister(){
//        if(Auth::check()){
//            return Redirect::to('/');
//        }else{
//            return View::make('user.email-registration');
//        }
//    }

    public function getForgotPassword(){
        return View::make('user.password-reset-send');
    }

    public function getResendConfirmation($email){
        try{
            Notifier::sendConfirmationEmail($email);
        }catch(Exception $e){}
        json_encode(['success' => 1]);
    }

    public function postSendReset(){
        $email = Input::get('email');
        $user = User::where('email', '=', $email)->first();
        if($user){
            $code = Crypt::encrypt($user->user_id);
            $url = url('/user/password-reset') . '/' . $code;
            $message = 'To reset your password, click this <a href="' . $url . '">link</a>.';
        }else{
            $url = url('/user/register');
            $message = 'You are not yet registered to FeatherQ. To register, click this <a href="' . $url . '">link</a>.';
        }

        Notifier::sendPasswordResetEmail($email, $message);
        return json_encode(['success' => 1]);
    }

    public function getVerifyEmail($email){
        if(Auth::check()) {
            return Redirect::to('/');
        }else{
            $user = User::where('email', '=', $email)->first();
            if($user && $user->verified == 0){
                return View::make('user.email-verify')->with('email', $email);
            }else{
                return Redirect::to('/user/login');
            }
        }
    }

    public function getPasswordReset($code){
        Auth::logout();
        $user_id = Crypt::decrypt($code);
        return View::make('user.password-reset')
            ->with('user_id', $user_id)
            ->with('error', '');
    }

    public function postPasswordReset(){
        $user_id = Input::get('user_id');
        $password = Input::get('password');
        $password_confirm = Input::get('password_confirm');
        $error = '';
        $success = '';

        if($password == ''){
            $error = 'Passwords should not be empty.';
        }else if($password != $password_confirm){
            $error = 'Passwords do not match.';
        }else{
            $user = User::find($user_id);
            if($user){
                $user->password = Hash::make($password);
                $user->save();
                $success = 'Password has been reset. Login <a href="/user/login">here</a>';
            }else{
                $error = 'User not found.';
            }
        }

        if($error){
            return View::make('user.password-reset')
                ->with('user_id', $user_id)
                ->with('error', $error);
        }else if($success){
            return View::make('user.password-reset')
                ->with('user_id', $user_id)
                ->with('success', $success);
        }else{
            return Redirect::to('/user/login');
        }

    }
}