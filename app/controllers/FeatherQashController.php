<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/4/15
 * Time: 3:06 PM
 */

class FeatherQashController extends BaseController {

    public function postAdd(){
        if((Input::get('user_id') == Helper::userId()) || Admin::isAdmin()){
            $details = [
                'description' => Input::get('description'),
                'payment_gateway' => Input::has('payment_gateway') ? Input::get('payment_gateway') : ''
            ];

            $success = FeatherQash::addFeatherQashTransaction(Input::get('user_id'), Input::get('amount'), 1, $details);
            return json_encode(['success' => $success]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function postUse(){
        if((Input::get('user_id') == Helper::userId()) || Admin::isAdmin()){
            $details = [
                'description' => Input::get('description'),
            ];

            $success = FeatherQash::addFeatherQashTransaction(Input::get('user_id'), Input::get('amount'), 0, $details);
            return json_encode(['success' => $success]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getAccount($user_id){
        if(($user_id == Helper::userId()) || Admin::isAdmin()){
            $account = FeatherQash::getUserFeatherQashAccount($user_id);
            return json_encode(['success' => 1, 'account' => $account]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getAccountHistory($user_id){
        if(($user_id == Helper::userId()) || Admin::isAdmin()){
            $transactions = FeatherQash::getUserFeatherQashTransactions($user_id, 10);
            return json_encode(['success' => 1, 'transactions' => $transactions]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }
}