<?php
/**
 *
 * Should contain business related functions
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:10 PM
 */


class BusinessController extends BaseController{

    public function postSetup(){

        $business = [
            'business_name' => Input::get('business_name'),
            'business_address' => Input::get('busienss_address'),
            'time_open'
        ];
    }
}