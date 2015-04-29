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
            'referrer_url'      => null,
            'page_url'          => $input['page_url'],
            'latitude'          => $input['latitude'],
            'longitude'         => $input['longitude'],
            'browser'           => $input['browser'],
            'operating_system'  => $input['operating_system'],
        ];

        if($data['user_id']){
            $data['gender']         = User::gender($data['user_id']);
            $data['nationality']    = User::nationality($data['user_id']);
            $data['civil_status']   = User::civil_status($data['user_id']);
            $data['birth_day']      = date('d', User::birthdate($data['user_id']));
            $data['birth_month']    = date('m', User::birthdate($data['user_id']));
            $data['birth_year']     = date('Y', User::birthdate($data['user_id']));
            $data['age']            = User::age($data['user_id']);
        }

        $id = ViewHistory::addViewHistory($data);
        return json_encode(['success' => 1, 'log_id' => $id]);
    }
}