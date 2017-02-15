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
require 'FreeApi/FreeBroadcast.php';
require 'FreeApi/FreeMeans.php';
require 'FreeApi/FreeQueueStatus.php';

class FreeApi {

    private $search, $auth, $business, $queue, $broadcast, $means, $status;
    public function __construct(){
        $this->search = new FreeSearch();
        $this->auth = new FreeAuth();
        $this->business = new FreeBusiness();
        $this->queue = new FreeQueue();
        $this->broadcast = new FreeBroadcast();
        $this->means = new FreeMeans();
        $this->status = new FreeQueueStatus();
    }

    public function grantAccess($request){
        return $this->auth->grantAccess($request);
    }

    public function getCategories(){
        return $this->business->businessCategories();
    }

    public function postBusinessSearch($data){
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

    public function postUpdateBusiness($data){
        return $this->business->updateBusiness($data);
    }

    public function postIssueNumber($data){
        return $this->queue->issueNumber($data);
    }

    public function getAllNumbers($business_id){
        return $this->queue->getNumbers($business_id);
    }

    public function getCallNumber($transaction_number){
        return $this->queue->callNumber($transaction_number);
    }

    public function getServeNumber($transaction_number){
        return $this->queue->serveNumber($transaction_number);
    }

    public function getDropNumber($transaction_number){
        return $this->queue->dropNumber($transaction_number);
    }

    public function postResetPassword($data){
        return $this->auth->resetPassword($data);
    }

    public function postEmailVerification($data){
        return $this->auth->emailVerification($data);
    }

    public function postVerifyCode($data){
        return $this->auth->verifyCode($data);
    }

    public function putChangePassword($data){
        return $this->auth->changePassword($data);
    }

    public function putUpdatePassword($data){
        return $this->auth->updatePassword($data);
    }

    public function getBusinessBroadcast($business_id){
        return $this->broadcast->businessBroadcast($business_id);
    }

    public function getCustomerBroadcast($business_id){
        return $this->broadcast->customerBroadcast($business_id);
    }

    public function getEstimatedTime($business_id){
        return $this->queue->getServingTime($business_id);
    }

    public function postUpdateMeanweights($data) {
        return $this->means->postUpdateMeanweights($data);
    }

    public function getMeanWeights($service_id) {
        return $this->means->getMeanWeights($service_id);
    }
    
    public function postPunchQueuestatus($data) {
        return $this->status->postPunchQueuestatus($data);
    }

}