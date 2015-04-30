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
        $data = [
            'user_id'           => Helper::userId(),
            'ip_address'        => Helper::getIP(),
            'referrer_url'      => $input['referrer_url'],
            'page_url'          => $input['page_url'],
            'latitude'          => $input['latitude'],
            'longitude'         => $input['longitude'],
            'browser'           => $input['browser'],
            'operating_system'  => $input['operating_system'],
            'screen_size'       => $input['screen_size'],
        ];

        if($data['user_id']){
            $birthdate              = User::birthdate($data['user_id']);
            $data['gender']         = User::gender($data['user_id']);
            $data['nationality']    = User::nationality($data['user_id']);
            $data['civil_status']   = User::civil_status($data['user_id']);
            $data['birth_day']      = $birthdate ? date('d', $birthdate) : null;
            $data['birth_month']    = $birthdate ? date('m', $birthdate) : null;
            $data['birth_year']     = $birthdate ? date('Y', $birthdate) : null;
            $data['age']            = User::age($data['user_id']);
        }

        $id = ViewHistory::addViewHistory($data);
        return json_encode(['success' => 1, 'log_id' => $id]);
    }
}