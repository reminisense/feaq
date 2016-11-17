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

class FreeApi {

    private $search;
    private $auth;

    public function __construct(){
        $this->search = new FreeSearch();
        $this->auth = new FreeAuth();
        $this->business = new FreeBusiness();
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

}