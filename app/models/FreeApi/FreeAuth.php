<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 6:39 PM
 */
class FreeAuth {
    private $allowed_urls = [
        'api/register',
        'api/login',
        'api/search-business',
        'api/reset-password',
        'api/email-verification',
        'api/verify-code',
        'api/customer-broadcast',
        'api/change-password',
        'api/categories'
    ];

    private $freeBusiness, $freeQueue;
    public function __construct(){
        $this->freeBusiness = new FreeBusiness();
        $this->freeQueue = new FreeQueue();
    }

    /**
     * grants access to users that are logged in on the site and have an access key
     * @param $request
     * @return mixed
     */
    public function grantAccess($request){
        if(!$this->pathAllowed($request->path())){
            $auth_token = Request::header('Authorization');
            if (!$this->checkAccessKey($auth_token)) {
                return Response::json(array(
                    'msg' => 'Your access token is not valid.',
                    'status' => 403,
                ));
            }
        }
    }

    /**
     * Crate user and business
     * @param $data[email]
     * @param $data[password]
     * @param $data[password_confirm]
     * @param $data[name]
     * @param $data[address]
     * @param $data[logo]
     * @param $data[category]
     * @param $data[time_close]
     * @param $data[number_start]
     * @param $data[number_limit]
     * @param $data[device_token]
     * @param $data[platform]
     * @return mixed
     */
    public function register($data){
        //@todo data checking
        $data = $this->checkRegistrationData($data);
        if(isset($data['error'])){
            return json_encode($data);
        }

        //create user
        $user_details = [
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];
        $user_id = User::insertGetId($user_details);

        //create business
        $time_array = Helper::parseTime($data['time_close']);
        $business_details = [
            'name' => $data['name'],
            'local_address' => $data['address'],
            'industry' => $data['category'],
            'close_hour' => $time_array['hour'],
            'close_minute' => $time_array['min'],
            'close_ampm' => $time_array['ampm'],
            'free_account' => 1,
            'raw_code' => Helper::generateRawCode(),
            'logo' => $data['logo'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ];
        $business_id = $this->freeBusiness->createBusiness($user_id, $business_details);
//        if(isset($data['logo']) && $data['logo'] != null){
//            $this->freeBusiness->uploadBusinessLogo($data['logo'], $business_id);
//        }

        //create business branch, service, and terminal
        $this->freeBusiness->createBusinessSetup($business_id, $data['name'], $data['number_start'], $data['number_limit']);
        return $this->login(['email' => $data['email'], 'password' => $data['password'], 'device_token' => $data['device_token'], 'platform' => $data['platform']]);
    }

    /**
     * @param $data[email]
     * @param $data[password]
     * @param $data[device_token]
     * @param $data[platform]
     * @return mixed
     */
    public function login($data){
        if(!isset($data['email'])){
            return json_encode(['error' => 'Invalid email.']);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error' => "Invalid email format."]);
        }

        if(!isset($data['password'])){
            return json_encode(['error' => 'Password is missing.']);
        }

        if(!isset($data['device_token'])){
            return json_encode(['error' => 'Device token is missing.']);
        }

        if(!isset($data['platform'])){
            return json_encode(['error' => 'Platform is missing.']);
        }

        $user = User::where('email', '=', $data['email'])->first();
        if($user){
            if(Hash::check($data['password'], $user->password)){
                $business_id = $this->saveLogin($user->user_id, $data['platform'], $data['device_token']);
                $all_numbers = $this->freeQueue->allNumbers($business_id);
                return json_encode([
                    'success' => 1,
                    'access_token' => $this->generateAccessKey($user->user_id),
                    'business_id' => $business_id,
                    'service_id' => $all_numbers->service_id,
                    'issued_numbers' => $all_numbers->uncalled_numbers,
                    'called_numbers' => $all_numbers->called_numbers,
                ]);
            }else{
                return json_encode(['error' => 'Passwords do not match.']);
            }
        }else{
            return json_encode(['error' => 'User does not exist.']);
        }
    }

    public function emailVerification($data){
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error' => "Invalid email format."]);
        }

        $secret = $this->getVerificationCode();
        try{
            if(DB::table('email_verification')->where('email', '=', $data['email'])->exists()){
                DB::table('email_verification')->where('email', '=', $data['email'])->update(['verification_code' => Hash::make($secret)]);
            }else{
                DB::table('email_verification')->insert(['email' => $data['email'], 'verification_code' => Hash::make($secret)]);
            }
            Notifier::sendEmail($data['email'], 'emails.auth.free-email-verification', 'Email_verification', ['verification_code' => $secret]);
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }

        return json_encode(['success' => 1, 'code' => $secret]);
    }

    public function verifyCode($data){
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error' => "Invalid email format."]);
        }

        try{
            return json_encode(['success' => $this->checkVerificationCode($data['email'], $data['verification_code'])]);
        }catch (Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function resetPassword($data){
        if(!isset($data['email'])){
            return json_encode(['error' => 'No email address']);
        }

        if(!User::where('email', '=', $data['email'])->exists()){
            return json_encode(['error' => 'User not found.']);
        }

        return $this->emailVerification($data);
    }

    public function changePassword($data){
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error' => "Invalid email format."]);
        }

        if(!$this->checkVerificationCode($data['email'], $data['verification_code'])){
            return json_encode(['error' => 'Invalid verification code.']);
        }

        if($data['password'] != $data['password_confirm']){
            return json_encode(['error' => 'Passwords do not match.']);
        }

        User::where('email', '=', $data['email'])->update(['password' => Hash::make($data['password'])]);
        return json_encode(['success' => 1]);
    }

    public function updatePassword($data){
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return json_encode(['error' => "Invalid email format."]);
        }

        if($data['password'] != $data['password_confirm']){
            return json_encode(['error' => 'Passwords do not match.']);
        }

        User::where('email', '=', $data['email'])->update(['password' => Hash::make($data['password'])]);
        return json_encode(['success' => 1]);
    }

    /**
     * check for errors in the data
     * @param $data
     * @return mixed
     */
    private function checkRegistrationData($data){
        if(!isset($data['email'])){
            return ['error' => 'Invalid email.'];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return ['error' => "Invalid email format."];
        }

        if(User::where('email', '=', $data['email'])->exists()){
            return ['error' => "User already exists."];
        }

        if(!isset($data['password'])){
            return ['error' => 'Password is missing.'];
        }

        if(!isset($data['password_confirm'])){
            return ['error' => 'Please retype password.'];
        }

        if($data['password'] != $data['password_confirm']){
            return ['error' => 'Passwords do not match.'];
        }

        if(!isset($data['name'])){
            return ['error' => 'Business name is missing.'];
        }

        if(!isset($data['address'])){
            return ['error' => 'Address is missing.'];
        }

        if(!isset($data['category'])){
            return ['error' => 'Category is missing.'];
        }

        if(!isset($data['time_close'])){
            return ['error' => 'Time close is missing'];
        }

        if(!preg_match('/^([1-9]|1[0-2]|0[1-9]){1}(:[0-5][0-9] [aApP][mM]){1}$/', $data['time_close'])){
            return ['error' => 'Invalid time format.'];
        }

        if(!isset($data['number_start'])){
            return ['error' => 'Number start is missing.'];
        }

        if(!is_numeric($data['number_start'])){
            return ['error' => 'Invalid number.'];
        }

        if(!isset($data['number_limit'])){
            return ['error' => 'Number limit is missing.'];
        }

        if(!is_numeric($data['number_limit'])){
            return ['error' => 'Invalid number.'];
        }

        if(!isset($data['device_token'])){
            return ['error' => 'Device token is missing.'];
        }

        if(!isset($data['platform'])){
            return ['error' => 'Platform is missing.'];
        }

        if(!isset($data['logo'])){
            $data['logo'] = '';
        }

        if(isset($data['latitude']) && !is_numeric($data['latitude'])){
            return ['error' => 'Incorrect latitude value.'];
        }

        if(isset($data['longitude']) && !is_numeric($data['longitude'])){
            return ['error' => 'Incorrect longitude value.'];
        }

        return $data;
    }

    private function getVerificationCode(){
        return \RandomStringGenerator::generate(8);
    }

    private function checkVerificationCode($email, $code){
        $email = DB::table('email_verification')->where('email', '=', $email)->first();
        if($email){
            return Hash::check($code, $email->verification_code) ? 1 : 0;
        }
        return 0;
    }

    private function saveLogin($user_id, $platform, $device_token){
        $business_id = UserBusiness::getBusinessIdByOwner($user_id);
        DB::table('business_login')->insert([
            'device_token' => $device_token,
            'business_id' => $business_id,
            'action' => 1,
            'platform' => $platform,
            'added_on' => time(),
        ]);

        return $business_id;
    }

    private function generateAccessKey($user_id){
        $user = User::where('user_id', '=', $user_id)->first();
        if($user->auth_token != ''){
            $auth_token = $user->auth_token;
        }else{
            $auth_token = Hash::make($user_id);
            $user->auth_token = $auth_token;
            $user->save();
        }
        return $auth_token;
    }

    private function checkAccessKey($auth_token){
        return User::getValidateToken($auth_token) || $auth_token;
    }

    private function pathAllowed($path){
        if(in_array($path, $this->allowed_urls)){
            return true;
        }else{
            foreach($this->allowed_urls as $url){
                if(is_numeric(strpos($path, $url))){
                    return true;
                }
            }
        }
        return false;
    }
}