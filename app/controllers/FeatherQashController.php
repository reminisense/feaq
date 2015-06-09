<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/4/15
 * Time: 3:06 PM
 */

class FeatherQashController extends BaseController {

    //creates a row in transaction history that adds to current account value
    public function postAdd(){
        if((Input::get('user_id') == Helper::userId()) || Admin::isAdmin()){
            $details = [
                'description' => Input::get('description'),
                'payment_gateway' => Input::has('payment_gateway') ? Input::get('payment_gateway') : ''
            ];

            $transaction_id = FeatherQash::createFeatherQashTransaction(Input::get('user_id'), Input::get('amount'), 1, $details);
            $transaction_key = Crypt::encrypt($transaction_id);
            return json_encode(['success' => 1, 'key' => $transaction_key]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }


    //creates a row in transaction history that subtracts from current account value
    public function postUse(){
        if((Input::get('user_id') == Helper::userId()) || Admin::isAdmin()){
            $details = [
                'description' => Input::get('description'),
            ];

            $transaction_id = FeatherQash::createFeatherQashTransaction(Input::get('user_id'), Input::get('amount'), 0, $details);
            if(!$transaction_id){ return json_encode(['error' => 'Not Enough FeatherQash.']); }
            $transaction_key = Crypt::encrypt($transaction_id);
            return json_encode(['success' => 1, 'key' => $transaction_key]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getUpdateAccount($key){
        $transaction_id = Crypt::decrypt($key);
        $transaction = DB::table('featherqash_tracker')->where('transaction_id', '=', $transaction_id)->first();
        $computed_amount = FeatherQash::getFeatherQashTransactionsComputedAmount($transaction->user_id);
        FeatherQash::updateUserFeatherQash($transaction->user_id, $computed_amount, $transaction_id);
        return json_encode(['success' => 1, 'user_id' => $transaction->user_id]);
    }

    public function getAccount($user_id){
        if(($user_id == Helper::userId()) || Admin::isAdmin()){
            $user = User::getUserByUserId($user_id);
            $account = FeatherQash::getUserFeatherQashAccount($user_id);
            return json_encode(['success' => 1, 'account' => $account, 'user' => $user]);
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