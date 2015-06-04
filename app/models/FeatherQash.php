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
        $details['previous_amount'] = $account_data->current_amount;
        $details['new_amount'] = $action == 0 ? $account_data->current_amount - $amount : $account_data->current_amount + $amount;

        $values = [
            'user_id' => $user_id,
            'amount' => $amount,
            'action' => $action,
            'details' => serialize($details)
        ];

        $transaction_id = DB::table('featherqash_tracker')->insertGetId($values);
        FeatherQash::updateUserFeatherQash($user_id, $details['new_amount'], $transaction_id);
    }

    public static function updateUserFeatherQash($user_id, $current_amount, $last_transaction_id){
        DB::table('featherqash')->where('user_id', '=', $user_id)->update(['current_amount' => $current_amount, 'latest_transaction_id' => $last_transaction_id]);
    }

    public static function getUserFeatherQashAccount($user_id){
        return DB::table('featherqash_user')->where('user_id', '=', $user_id)->first();
    }

}