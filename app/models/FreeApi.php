<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 2:47 PM
 */
require 'FreeApi/FreeSearch.php';
require 'FreeApi/FreeAuth.php';

class FreeApi extends Eloquent {

    private $search;
    private $auth;

    public function __construct(){
        $this->search = new FreeSearch();
        $this->auth = new FreeAuth();
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

}