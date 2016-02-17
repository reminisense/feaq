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
        return json_encode(['success' => 1, 'user' => $user]);
    }

    public function getUserByEmail($email){
        $user = User::searchByEmail($email);

        return json_encode(array_merge($user, array(
            'status' => User::getStatusByUserId($user['user_id']),
            'address' => User::local_address($user['user_id']),
            'phone' => User::phone($user['user_id'])
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
        if($user_id != 0){
            return json_encode(array('status' => '1', 'first_name' => User::first_name($user_id), 'last_name' => User::last_name($user_id), 'phone' => User::phone($user_id), 'email' => User::email($user_id)));
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
                $verification_url = url('/user/verify-email');
                return json_encode(['error' => 'Email verification required. Go ' . $verification_url . '/{your email} to verify your account.']);
            }else if($user && Hash::check($password, $user->password)){
                Session::put('FBaccessToken', null);
                Auth::loginUsingId($user->user_id);
                if (UserBusiness::getBusinessIdByOwner($user->user_id)) {
                    return json_encode(array('success' => 1, 'redirect' => '/business/my-business'));
                }
                else {
                    return json_encode(array('success' => 1, 'redirect' => '/'));
                }
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

    public function getRegister(){
        if(Auth::check()){
            return Redirect::to('/');
        }else{
            return View::make('user.email-registration');
        }
    }

    public function getForgotPassword(){
        return View::make('user.password-reset-send');
    }

    public function getResendConfirmation($email){
        try{
            Notifier::sendConfirmationEmail($email);
        }catch(Exception $e){}
        return Redirect::back();
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