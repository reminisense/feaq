<?php
/**
 * Created by PhpStorm.
 * User: aunne
 * Date: 01/02/2016
 * Time: 11:35 AM
 */


class MobileController extends BaseController{

    public function getBusinessNumbers($business_id, $user_id){
        $business = Business::where('business_id', '=', $business_id)->first();
        $services = Service::getServicesByBusinessId($business_id);

        $services_list = [];
        foreach($services as $service){
            $services_list[] = [
                "service_id"=> $service->service_id,
                "service_name"=> $service->name,
                "enabled"=> QueueSettings::allowRemote($service->service_id) > 0 ? true : false,
            ];
        }

        $broadcast_numbers = [];
        $last_called = null;
        $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);
        if($all_numbers){
            $last_called = count($all_numbers->called_numbers) > 0 ? $all_numbers->called_numbers[0]['priority_number'] : null;
            foreach($all_numbers->called_numbers as $number){
                $number = json_decode(json_encode($number));
                $broadcast_numbers[] = [
                    "number"=> $number->priority_number,
                    "service_id"=> $number->service_id,
                    "service_name"=> $number->service_name,
                    "terminal_id"=> $number->terminal_id ? $number->terminal_id : null,
                    "terminal_name"=> $number->terminal_name ? $number->terminal_name : null,
                    "rank"=> $number->box_rank ? $number->box_rank : null,
                ];
            }
        }

        $user = User::where('user_id', '=', $user_id)->first();
        if($user){
            $transaction_number = PriorityQueue::getLatestTransactionNumberOfUser($user_id);
            if($transaction_number){
                $terminal_transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();
                $priority_queue = PriorityQueue::find($transaction_number);
                $priority_number = PriorityNumber::find($priority_queue->track_id);
                $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

                $issued_today = $priority_number->date == $date;
                if($issued_today && $terminal_transaction->time_completed > 0){
                    $user_status = 'served';
                }else if($issued_today && $terminal_transaction->time_called > 0){
                    $user_status = 'called';
                }else if($issued_today && $terminal_transaction->time_issued > 0){
                    $user_status = 'in_queue';
                }else{
                    $user_status = 'not_queued';
                }
            }else{
                $user_status = 'not_queued';
            }
        }else{
            $user_status = 'user_not_found';
        }


        return json_encode([
            "business_id"=> $business->business_id,
            "business_name"=> $business->name,
            "business_address"=> $business->local_address,
            "last_number_called"=> $last_called,
            "user_status"=> $user_status,
            "service_list"=> $services_list,
            "broadcast_numbers"=> $broadcast_numbers,
        ]);
    }

    //Screen #1
    public function getActiveBusinesses(){
        $active_businesses = [];
        $businesses = Business::all();

        foreach($businesses as $business){
            if(Business::processingBusinessBool($business->business_id)){
                $services = Service::getServicesByBusinessId($business->business_id);
                $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);

                if(count($all_numbers->called_numbers) > 0){
                    $last_called = json_decode(json_encode($all_numbers->called_numbers[0]));
                    $last_called->service_id = Terminal::serviceId($last_called->terminal_id);
                    $last_called->user_id = PriorityQueue::userId($last_called->transaction_number);
                    $last_called = [
                        'service_id' => $last_called->service_id,
                        'service_name' => $last_called->service_name,
                        'terminal_id' => $last_called->terminal_id,
                        'terminal_name' => $last_called->terminal_name,
                        'queue_number' => $last_called->priority_number,
                        'queue_user_id' => $last_called->user_id,
                        'queue_user_name' => $last_called->name,
                        'queue_user_email' => $last_called->email,
                        'queue_user_contact' => $last_called->phone,
                    ];
                    $last_called_array = $last_called;
                }else{
                    $last_called = null;
                    $last_called_array = [];
                }

                $services_list = [];
                $allow_remote = false;
                foreach($services as $service){
                    $enabled = QueueSettings::allowRemote($service->service_id) > 0 ? true : false;
                    $allow_remote = $enabled ? true : $allow_remote;
                    $services_list[] = [
                        'service_id' => $service->service_id,
                        'name' => $service->name,
                        'enabled' => $enabled
                    ];
                }

                $active_businesses[] = [
                    'id' => $business->business_id,
                    'name' => $business->name,
                    'address' => $business->local_address,
                    'image_url' => "http://imgur.com/as1DaJ.jpg",
                    'time_requested' => time() * 1000, //convert to milliseconds
                    'remote_queue' => $allow_remote,
                    'service_list'  => $services_list,
                    'last_called' => $last_called,
                    'last_called_array' => $last_called_array,
                ];
            }
        }
        return json_encode($active_businesses);
    }

    //Screen #5
    public function getUserQueue($user_id)
    {
        $user = User::find($user_id);
        $transaction_number = PriorityQueue::getLatestTransactionNumberOfUser($user->user_id);
        $terminal_transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();

        $data = [];
        if(isset($terminal_transaction) && $terminal_transaction->time_completed == 0 && $terminal_transaction->time_removed == 0){
            //user priority_number details
            $priority_queue = PriorityQueue::find($transaction_number);
            $priority_number = PriorityNumber::find($priority_queue->track_id);
            $queued_business_id = Business::getBusinessIdByServiceId($priority_number->service_id);
            $business = Business::find($queued_business_id);

            //business queueing status details
            $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);
            if(count($all_numbers->called_numbers) > 0){
                $last_called = json_decode(json_encode($all_numbers->called_numbers[0]));
                $last_called->service_id = Terminal::serviceId($last_called->terminal_id);
                $last_called->user_id = PriorityQueue::userId($last_called->transaction_number);
                $last_called = [
                    'service_id' => $last_called->service_id,
                    'service_name' => $last_called->service_name,
                    'terminal_id' => $last_called->terminal_id,
                    'terminal_name' => $last_called->terminal_name,
                    'queue_number' => $last_called->priority_number,
                    'queue_user_id' => $last_called->user_id,
                    'queue_user_name' => $last_called->name,
                    'queue_user_email' => $last_called->email,
                    'queue_user_contact' => $last_called->phone,
                ];
            }else{
                $last_called = null;
            }

            $data = [
                'user_id' => $user->user_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'contact' => $user->phone,
                'transaction_number' => $transaction_number,
                'priority_number' => $priority_queue->priority_number,
                'estimated_time_left' => Analytics::getWaitingTimeByTransactionNumber($transaction_number),
                'business' => [
                    'id' => $business->business_id,
                    'name' => $business->name,
                    'address' => $business->local_address,
                    'image_url' => "http://imgur.com/as1DaJ.jpg",
                    'last_called' => $last_called,
                ],
                'location' => [
                    'latitude' => $business->latitude,
                    'longitude' => $business->longitude,
                ],

            ];
            return json_encode($data);
        }else{
            return '{}';
        }

    }

    //Screen #6
    public function getMyAllHistory($user_id, $limit = 5, $offset = 0){

        $user_queues = User::getUserHistory($user_id, $limit, $offset);
        $businesses = array();

        for($i = 0; $i < count($user_queues); $i++){
            array_push($businesses, [
                'id' =>  $user_queues[$i]['transaction_number'],
                'business_id' => $user_queues[$i]['business_id'],
                'business_name' => $user_queues[$i]['business_name'],
                'image_url' => '',
                'status' => $user_queues[$i]['status'],
                'transaction_length' => $user_queues[$i]['time_completed'] - $user_queues[$i]['time_queued'] > 0 ? $user_queues[$i]['time_completed'] - $user_queues[$i]['time_queued'] : 0,
                'priority_number' => $user_queues[$i]['priority_number'],
                'rating' => UserRating::getUserRating($user_queues[$i]['transaction_number']) ? UserRating::getUserRating($user_queues[$i]['transaction_number'])->rating : 0,
                'transaction_date' => $user_queues[$i]['date']
            ]);
        }

        return json_encode($businesses);

    }

    //Screen #7
    public function getMyBusinessHistory($transaction_number){
        $user_queues = PriorityQueue::getTransactionHistory($transaction_number);
        $service_id = Terminal::serviceId(TerminalTransaction::terminalId($transaction_number));
        $business = [
            'business_id' => $user_queues->business_id,
            'transaction_date' => $user_queues->date,
            'business_name' => $user_queues->business_name,
            'address' => $user_queues->business_address,
            'location' => [
                'longitude' => $user_queues->longitude,
                'latitude' => $user_queues->latitude
            ],
            'status' => $user_queues->status,
            'priority_number' => $user_queues->priority_number,
            'time_issued' => $user_queues->time_queued,
            'time_called' => $user_queues->time_called,
            'service_id' => $service_id,
            'service_name' => Service::name($service_id),
            'rating' => UserRating::getUserRating($transaction_number) ? UserRating::getUserRating($transaction_number)->rating : 0
        ];

        return json_encode($business);
    }

    //Screen #10
    public function postSendMessage(){
        $user_id = Input::get('user_id');
        $business_id = Input::get('business_id');
        $message = Input::get('message');

        $email = User::email($user_id);
        $timestamp = time();
        $thread_key = Helper::threadKeyGenerator($business_id, $email);

        if (!Message::checkThreadByKey($thread_key)) {
            $phones[] = Input::get('contmobile');
            Message::createThread(array(
                'contactname' => User::first_name($user_id) . ' ' . User::last_name($user_id),
                'business_id' => $business_id,
                'email' => $email,
                'phone' => serialize($phones),
                'thread_key' => $thread_key,
            ));
            $data = json_encode(array(
                array(
                    'timestamp' => $timestamp,
                    'contmessage' => $message,
                    'sender' => 'user',
                )
            ));
            file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
        }
        else {
            $data = json_decode(file_get_contents(public_path() . '/json/messages/' . $thread_key . '.json'));
            $data[] = array(
                'timestamp' => $timestamp,
                'contmessage' => $message,
                'sender' => 'user',
            );
            $data = json_encode($data);
            file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
        }
        return json_encode(array('business_id' => $business_id, 'user_id' => $user_id, 'message' => $message));
    }

    //Screen #12
    public function getBusinessStatus($business_id, $get_services = true)
    {
        $business = Business::where('business_id', '=', $business_id)->first();
        if(!$business){
            json_encode(['error' => 'Business not fouund.']);
        }else{
            $json_path = public_path() . '/json/' . $business->business_id . '.json';
            $json_contents = file_get_contents($json_path);
            $json = json_decode($json_contents);
            $all_numbers = ProcessQueue::businessAllNumbers($business->business_id);
            $all_numbers = json_decode(json_encode($all_numbers));
            $data = [
                'business_id' => $business->business_id,
                'business_name' => $business->name,
                'ticker_message' => $json->ticker_message,
                'ticker_message2' =>$json->ticker_message2,
                'ticker_message3' =>$json->ticker_message3,
                'ticker_message4' =>$json->ticker_message4,
                'ticker_message5' =>$json->ticker_message5,
            ];

            //get services list
            if($get_services){
                $service_list = array();
                $services = Service::getServicesByBusinessId($business->business_id);
                foreach($services as $service){
                    array_push($service_list, [
                        'id' => $service->service_id,
                        'name' => $service->name,
                        'isEnabled' => QueueSettings::allowRemote($service->service_id) ? true : false,
                    ]);
                }
                $data['service_list'] = $service_list;
            }
            $broadcast_numbers = array();
            if($all_numbers){
                $max_count = explode("-", $json->display)[1];
                $box_count = 1;

                if(!isset($json->show_issued) || $json->show_issued){
                    $numbers =  array_merge($all_numbers->called_numbers, $all_numbers->uncalled_numbers);
                }else{
                    $numbers = $all_numbers->called_numbers;
                }

                foreach($numbers as $number){
                    if($box_count <= $max_count){ $box_count++; }else{ break; }
                    $user = $number->email ? User::searchByEmail($number->email) : null;
                    $user = json_decode(json_encode($user));
                    array_push($broadcast_numbers, [
                        'service_id' => $number->service_id,
                        'service_name' => $number->service_name,
                        'terminal_id' => isset($number->terminal_id) ? $number->terminal_id : null,
                        'terminal_name' => isset($number->terminal_name) ? $number->terminal_name : null,
                        'priority_number' => $number->priority_number,
                        'user_id' => $user ? $user->user_id : null,
                        'user_first_name' => $user ? $user->first_name : $number->name
                    ]);
                }
            }
            $data['broadcast_numbers'] = $broadcast_numbers;
            return json_encode($data);
        }
    }

    //Screen #13
    // Use this function when the user_id is in a remote queue. Otherwise this will result in an object not found error.
    public function getBusinessBroadcast($business_id, $user_id){
        $data = $this->getBusinessStatus($business_id, false);
        $data = json_decode($data);

        if($user_id){
            $user = User::find($user_id);
            $transaction_number = PriorityQueue::getLatestTransactionNumberOfUser($user->user_id);
            $terminal_transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();
            $priority_queue = PriorityQueue::find($transaction_number);
            $priority_number = PriorityNumber::find($priority_queue->track_id);

            if($terminal_transaction->time_completed == 0 && $terminal_transaction->time_removed == 0){
                $data->service_name = Service::name($priority_number->service_id);
                $data->user_priority_number = $priority_queue->priority_number;
                $data->number_people_ahead = Analytics::getNumbersAhead($transaction_number);
                $data->estimated_time_left = Analytics::getWaitingTimeByTransactionNumber($transaction_number);
            }

        }

        return json_encode($data);
    }

    /**
     * to check for the correct access key, tue access_key variable should be placed in the request header
     * and validated using the Helper::checkAccessKey() function.
     */
    public function postEmailLogin(){
        $email = Input::get('email');
        $password = Input::get('password');

        if(isset($email) && $email != "" && isset($password) && $password != ""){
            $user = User::where('email', '=', $email)->first();
            $user_data = [
                'user_id' => $user->user_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'local_address' => $user->local_address,
                'gender' => $user->gender,
            ];
            if($user && !$user->verified){
                return json_encode(['error' => 'Email verification required.']);
            }else if($user && Hash::check($password, $user->password)){
                return json_encode(['success' => 1, 'user'=> $user_data, 'access_token' => Helper::generateAccessKey()]);
            }else{
                return json_encode(['error' => 'The email or password is incorrect.']);
            }
        }else{
            return json_encode(['error' => 'The email or password should not be blank.']);
        }
    }

    public function postFacebookLogin(){
        $fb_id = Input::get('facebook_id');

        if(isset($fb_id) && $fb_id != ""){
            $user = User::where('fb_id', '=', $fb_id)->first();
            if($user && !$user->verified){
                return json_encode(['error' => 'Email verification required.']);
            }else if($user && $user->verified){
                $user_data = [
                    'user_id' => $user->user_id,
                    'facebook_id' => $user->fb_id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'local_address' => $user->local_address,
                    'gender' => $user->gender,
                ];
                return json_encode(['success' => 1, 'user'=> $user_data, 'access_token' => Helper::generateAccessKey()]);
            }else{
                return json_encode(['error' => 'User does not exist.']);
            }
        }else{
            return json_encode(['error' => 'The email or password should not be blank.']);
        }
    }

    public function postUpdateUser(){
        $user_id = Input::get('user_id');
        if(User::where('user_id', '=', $user_id)->exists()){
            $user = User::find($user_id);
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->phone = Input::get('phone');
            $user->local_address = Input::get('location');
            try{
                $user->save();
                $user_data = [
                    'user_id' => $user->user_id,
                    'facebook_id' => $user->fb_id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'local_address' => $user->local_address,
                    'gender' => $user->gender,
                ];
                return json_encode(['success' => 1, 'user'=> $user_data]);
            }catch (Exception $e){
                return json_encode(['error' => $e->getMessage()]);
            }
        }else{
            return json_encode(['error' => 'User does not exist.']);
        }
    }

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
                return json_encode(['success' => 1, 'message' => 'Your account has been created please check your email to confirm your registration.']);
            }catch(Exception $e){
                return json_encode(['success' => 1, 'error' => $e->getMessage()]);
            }
        }else{
            return json_encode(['error' => "There are missing parameters."]);
        }
    }

    public function getCheckinTransaction($transaction_number){
        if(TerminalTransaction::where('transaction_number', '=', $transaction_number)->exists()){
            $time_checked_in = time();
            TerminalTransaction::where('transaction_number', '=', $transaction_number)->update(['time_checked_in' => $time_checked_in]);
            return json_encode([
                'success' => 1,
                'time_checked_in' => $time_checked_in,
                'transaction_number' => $transaction_number
            ]);
        }else{
            return json_encode(['success' => 0, 'error' => 'Transaction number not found.']);
        }

    }

    public function getCheckedIn($transaction_number){
        if(TerminalTransaction::where('transaction_number', '=', $transaction_number)->exists()) {
            $transaction = TerminalTransaction::where('transaction_number', '=', $transaction_number)->first();
            $time_checked_in = isset($transaction->time_checked_in) ? $transaction->time_checked_in : 0;
            $is_checked_in = $time_checked_in ? true : false;
            return json_encode([
                'is_checked_in' => $is_checked_in,
                'time_checked_in' => $time_checked_in,
                'transaction_number' => $transaction_number,
            ]);
        }else{
            return json_encode(['success' => 0, 'error' => 'Transaction number not found.']);
        }
    }

    public function getCustomFieldsData($transaction_number){
        if(PriorityQueue::where('transaction_number', '=', $transaction_number)->exists()) {
            $result= PriorityQueue::where('transaction_number', '=', $transaction_number)->first(['custom_fields']);
            return json_decode($result->custom_fields);
        }else{
            return json_encode(['success' => 0, 'error' => 'Transaction number not found.']);
        }
    }

    public function getCustomFields($service_id){

        if(Forms::where('service_id', '=', $service_id)->exists()) {
            $fields = array();
            $res = Forms::getFieldsByServiceId($service_id);
            foreach ($res as $count => $data) {
                $field_data = unserialize($data->field_data);
                $fields[$data->form_id] = array(
                    'field_type' => $data->field_type,
                    'label' => $field_data['label'],
                    'options' => array_key_exists('options', $field_data) ? unserialize($field_data['options']) : array(),
                    'value_a' => array_key_exists('value_a', $field_data) ? $field_data['value_a'] : '',
                    'value_b' => array_key_exists('value_b', $field_data) ? $field_data['value_b'] : '',
                );
            }
            return json_encode($fields);
        }else{
            return json_encode(['success' => 0, 'error' => 'Transaction number not found.']);
        }
    }

    public function postInsertCustomFieldsData(){
        $data = Input::all();
        $result =  PriorityQueue::updateCustomFieldsOfNumber($data['transaction_number'], json_encode($data['input']));

        if($result){
            return json_encode(['success' => 1]);
        }else{
            return json_encode(['error' =>'Something Went Wrong']);
        }

    }

    public function getViewForm($form_id) {
        $fields = unserialize(Forms::getFieldsByFormId($form_id));
        return json_encode(array(
          'fields' => $fields
        ));
    }

  public function getDisplayForms($service_id) {
    $data = array();
    $forms = Forms::fetchFormsByServiceId($service_id);
    foreach ($forms as $form) {
      $data[] = array(
        'form_id' => $form->form_id,
        'form_name' => $form->form_name,
      );
    }
    return json_encode(array('success'=> 1, 'forms' => $data));
  }

    public function getServiceEstimates($service_id){
        $analytics = new Analytics();
        return $analytics->getServiceTimeEstimates($service_id);
    }

}