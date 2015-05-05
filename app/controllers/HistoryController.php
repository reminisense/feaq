<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 4/28/15
 * Time: 4:55 PM
 */

class HistoryController extends Controller{

    public function postLogVisit(){
        $input = Input::all();
        $user_id = Helper::userId();

        //get user environment information
        $data = [
            'ip_address'        => Helper::getIP(),
            'referrer_url'      => $input['referrer_url'],
            'page_url'          => $input['page_url'],
            'latitude'          => $input['latitude'],
            'longitude'         => $input['longitude'],
            'browser'           => $input['browser'],
            'operating_system'  => $input['operating_system'],
            'screen_size'       => $input['screen_size'],
        ];

        //get user data
        if($user_id){
            $birthdate              = User::birthdate($user_id);
            $data['gender']         = User::gender($user_id);
            $data['nationality']    = User::nationality($user_id);
            $data['civil_status']   = User::civil_status($user_id);
            $data['birth_day']      = $birthdate ? date('d', $birthdate) : null;
            $data['birth_month']    = $birthdate ? date('m', $birthdate) : null;
            $data['birth_year']     = $birthdate ? date('Y', $birthdate) : null;
            $data['age']            = User::age($user_id);
        }

        //get page information
        $url_data = explode('/', $input['page_url']);
        if($url_data[3] == 'broadcast' && $url_data[4] == 'business'){
            $data['business_id']    = $url_data[5];
        }

        $log_data = [
            'user_id'           => Helper::userId(),
            'action_type'       => 'page view',
            'value'             => serialize($data),
        ];

        $id = ViewHistory::addViewHistory($log_data);
        return json_encode(['success' => 1, 'log_id' => $id]);
    }

    public function getUserdata($keyword, $user_id = null){
        return ViewHistory::queryUserParameters($keyword, $user_id);
    }
}