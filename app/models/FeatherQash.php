<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/3/15
 * Time: 12:41 PM
 */

class FeatherQash extends Eloquent{
    public $timestamps = false;

    public static function addFeatherQashTransaction($user_id, $amount, $action, $details = array()){
        $account_data = FeatherQash::getUserFeatherQashAccount($user_id);
        $details['previous_amount'] = isset($account_data->current_amount) ?  $account_data->current_amount : 0;
        $details['new_amount'] = $action == 0 ? $details['previous_amount'] - $amount : $details['previous_amount'] + $amount;

        if($details['new_amount'] > 0){
            $values = [
                'user_id' => $user_id,
                'amount' => $amount,
                'action' => $action,
                'details' => serialize($details)
            ];

            $transaction_id = DB::table('featherqash_tracker')->insertGetId($values);
            FeatherQash::updateUserFeatherQash($user_id, $details['new_amount'], $transaction_id);
            return true;
        }else{
            return false;
        }
    }

    public static function updateUserFeatherQash($user_id, $current_amount, $last_transaction_id){
        if(DB::table('featherqash_user')->where('user_id', '=', $user_id)->first()){
            DB::table('featherqash_user')->where('user_id', '=', $user_id)->update(['current_amount' => $current_amount, 'latest_transaction_id' => $last_transaction_id]);
        }else{
            DB::table('featherqash_user')->insert(['user_id' => $user_id, 'current_amount' => $current_amount, 'latest_transaction_id' => $last_transaction_id]);
        }
    }

    public static function getUserFeatherQashAccount($user_id){
        return DB::table('featherqash_user')
            ->where('featherqash_user.user_id', '=', $user_id)
            ->join('user', 'user.user_id', '=', 'featherqash_user.user_id')
            ->select('user.user_id', 'user.first_name', 'user.last_name', 'user.email', 'featherqash_user.current_amount')
            ->first();
    }

    public static function getUserFeatherQashTransactions($user_id, $limit = 99){
        return DB::table('featherqash_tracker')->orderBy('transaction_id', 'desc')->where('user_id', '=', $user_id)->take($limit);
    }
}