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

        $log_data = [
            'user_id'           => Helper::userId(),
            'action_type'       => 'page view',
            'value'             => serialize($data),
        ];

        $id = ViewHistory::addViewHistory($log_data);
        return json_encode(['success' => 1, 'log_id' => $id]);
    }
}