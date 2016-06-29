<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/29/15
 * Time: 4:48 PM
 */

class TestController extends Controller{

    public function getTwilio($number, $message){
        return Notifier::sendTwilio($number, $message);
    }

    public function getStandardDeviation($service_id){
        $analytics = new Analytics();
        return $analytics->getServiceTimeEstimates($service_id);
    }
}