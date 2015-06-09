<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/3/15
 * Time: 12:41 PM
 */

class FeatherQash extends Eloquent{
    public $timestamps = false;

    public static function createFeatherQashTransaction($user_id, $amount, $action, $details = array()){
        $account_data = FeatherQash::getUserFeatherQashAccount($user_id);
        $details['previous_amount'] = isset($account_data->current_amount) ?  $account_data->current_amount : 0;
        $details['new_amount'] = $action == 0 ? $details['previous_amount'] - $amount : $details['previous_amount'] + $amount;

        if($details['new_amount'] >= 0){
            $values = [
                'user_id' => $user_id,
                'amount' => $amount,
                'action' => $action,
                'details' => serialize($details)
            ];

            $transaction_id = DB::table('featherqash_tracker')->insertGetId($values);
            return $transaction_id;
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
        $computed_amount = FeatherQash::getFeatherQashTransactionsComputedAmount($user_id);
        $account = DB::table('featherqash_user')
            ->where('featherqash_user.user_id', '=', $user_id)
            ->select('featherqash_user.current_amount')
            ->first();

        if($account && $account->current_amount == $computed_amount){
            return $account;
        }else{
            $account = new stdClass();
            $account->user_id = $user_id;
            $account->current_amount = $computed_amount;
            return $account;
        }
    }

    public static function getUserFeatherQashTransactions($user_id, $limit = 99){
        return DB::table('featherqash_tracker')->orderBy('transaction_id', 'desc')->where('user_id', '=', $user_id)->take($limit);
    }

    public static function getAddTransactionsTotal($user_id){
        return DB::table('featherqash_tracker')
            ->where('user_id', '=', $user_id)
            ->where('action', '=', 1)
            ->select(DB::raw('SUM(amount) as positive_amount'))
            ->first()
            ->positive_amount;
    }

    public static function getSubtractTransactionsTotal($user_id){
        return DB::table('featherqash_tracker')
            ->where('user_id', '=', $user_id)
            ->where('action', '=', 0)
            ->select(DB::raw('SUM(amount) as negative_amount'))
            ->first()
            ->negative_amount;
    }

    public static function getFeatherQashTransactionsComputedAmount($user_id){
        return FeatherQash::getAddTransactionsTotal($user_id) - FeatherQash::getSubtractTransactionsTotal($user_id);
    }
}