<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 6:39 PM
 */

class FreeAuth {
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
     */
    public function register($data){
        //@todo data checking
        $data = $this->checkRegistrationData($data);
        if($data['error']){
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
            'logo' => $data['logo'],
            'industry' => $data['category'],
            'close_hour' => $time_array['hour'],
            'close_minute' => $time_array['min'],
            'close_ampm' => $time_array['ampm'],
            'free_account' => 1,
            'raw_code' => Helper::generateRawCode(),
        ];
        $business_id = $this->createBusiness($user_id, $business_details);

        //create business branch, service, and terminal
        $this->createBusinessSetup($business_id, $data['name'], $data['number_start'], $data['number_limit']);
        return json_encode(['success' => 1, 'access_token' => $this->generateAccessKey($user_id)]);
    }

    /**
     * @param $data
     */
    public function login($data){
        $user = User::where('email', '=', $data['email'])->first();
        if($user){
            if(Hash::check($data['password'], $user->password)){
                return json_encode(['success' => 1, 'access_token' => $this->generateAccessKey($user->user_id)]);
            }else{
                return json_encode(['error' => 'Passwords do not match.']);
            }
        }else{
            return json_encode(['error' => 'User does not exist.']);
        }
    }

    public function emailVerification($data){
        $secret = $this->encrypt($data['email']);
        return json_encode(['success' => 1, 'code' => $secret]);
    }

    public function verifyCode($data){
        try{
            return json_encode(['success' => $this->compareCode($data['email'], $data['verification_code'])]);
        }catch (Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * grants access to users that are logged in on the site and have an access key
     * @param $request
     * @return mixed
     */
    public function grantAccess($request){
        if ($request->path() != 'api/register' && $request->path() != 'api/login') {
            $auth_token = Request::header('Authorization');
            if (!User::getValidateToken($auth_token) || !$auth_token) {
                return Response::json(array(
                    'msg' => 'Your access token is not valid.',
                    'status' => 403,
                ));
            }
        }
    }

    public function resetPassword($data){
        if(!isset($data['email'])){
            return json_encode(['error' => 'No email address']);
        }

        if(!User::where('email', '=', $data['email'])->exists()){
            return json_encode(['error' => 'User not found.']);
        }


        $temp_pass = \RandomStringGenerator::generate(8);
        try{
            Notifier::sendEmail($data['email'], 'emails.auth.free-password-reset', 'Password Reset', ['temp_pass' => $temp_pass]);
        }catch(Exception $e){
            return json_encode(['error' => $e->getMessage()]);
        }

        User::where('email', '=', $data['email'])->update(['password' => Hash::make($temp_pass)]);
        return json_encode(['success' => 1]);

    }

    public function changePassword($data){
        if($data['password'] != $data['password_confirm']){
            return json_encode(['error' => 'Passwords do not match.']);
        }

        User::where('email', '=', $data['email'])->update(['password' => Hash::make($data['password'])]);
        return json_encode(['success' => 1]);
    }

    private function generateAccessKey($user_id){
        $auth_token = Hash::make($user_id);
        User::where('user_id', '=', $user_id)->update(array('auth_token' => $auth_token));
        return $auth_token;
    }
    /**
     * check for errors in the data
     * @param $data
     * @return mixed
     */
    private function checkRegistrationData($data){
        if($data['password'] != $data['password_confirm']){
            return ['error' => 'Passwords do not match.'];
        }
        return $data;
    }

    /**
     * Insert business and user_business data
     * @param $user_id
     * @param $business_details
     * @return mixed
     */
    private function createBusiness($user_id, $business_details){
        //create business
        $business_id = Business::insertGetId($business_details);

        //create user business
        $user_business = [
            'user_id' => $user_id,
            'business_id' => $business_id,
        ];
        UserBusiness::insert($user_business);

        return $business_id;
    }

    /**
     * Create branch, service, terminal
     * @param $business_id
     * @param $business_name
     * @param int $number_start
     * @param int $number_limit
     */
    private function createBusinessSetup($business_id, $business_name, $number_start = 1, $number_limit = 99){
        //insert branch details
        $branch_details = [
            'business_id' => $business_id,
            'name' => $business_name . ' Branch',
        ];
        $branch_id = Branch::insertGetId($branch_details);

        //insert service details
        $service_details = [
            'branch_id' => $branch_id,
            'name' => $business_name . ' Service',
        ];
        $service_id = Service::insertGetId($service_details);

        //insert terminal details
        $terminal_details = [
            'service_id' => $service_id,
            'name' => 'Counter 1',
        ];
        Terminal::insert($terminal_details);

        //inser queue settings
        $queue_settings = [
            'date' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
            'service_id' => $service_id,
            'number_start' => $number_start,
            'number_limit' => $number_limit,
        ];
        QueueSettings::insertGetId($queue_settings);
    }

    private function encrypt($secret){
        return Crypt::encrypt($secret);
    }

    private function decrypt($code){
        return Crypt::decrypt($code);
    }

    private function compareCode($email, $code){
        return ($email === $this->decrypt($code)) ? 1 : 0;
    }
}