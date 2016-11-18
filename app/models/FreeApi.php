<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 2:47 PM
 */
require 'FreeApi/FreeSearch.php';
require 'FreeApi/FreeAuth.php';
require 'FreeApi/FreeBusiness.php';
require 'FreeApi/FreeQueue.php';

class FreeApi {

    private $search, $auth, $business, $queue;
    public function __construct(){
        $this->search = new FreeSearch();
        $this->auth = new FreeAuth();
        $this->business = new FreeBusiness();
        $this->queue = new FreeQueue();
    }

    public function grantAccess($request){
        return $this->auth->grantAccess($request);
    }

    public function getBusinessSearch($data){
        return $this->search->businessSearch($data);
    }

    public function postLogin($data){
        return $this->auth->login($data);
    }

    public function postRegister($data){
        return $this->auth->register($data);
    }

    public function getBusiness($business_id){
        return $this->business->businessDetails($business_id);
    }

    public function putBusiness($data){
        return $this->business->updateBusiness($data);
    }

    public function postIssueNumber($data){
        return $this->queue->issueNumber($data);
    }

    public function getAllNumbers($service_id){
        return $this->queue->allNumbers($service_id);
    }

}