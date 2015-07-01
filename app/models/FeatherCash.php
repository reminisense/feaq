<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 6/3/15
 * Time: 12:41 PM
 */

class FeatherCash extends Eloquent{
    public $timestamps = false;

    public static function createFeatherCashTransaction($user_id, $amount, $action, $details = array()){
        $account_data = FeatherCash::getUserFeatherCashAccount($user_id);
        $details['previous_amount'] = isset($account_data->current_amount) ?  $account_data->current_amount : 0;
        $details['new_amount'] = $action == 0 ? $details['previous_amount'] - $amount : $details['previous_amount'] + $amount;

        if($details['new_amount'] >= 0){
            $values = [
                'user_id' => $user_id,
                'amount' => $amount,
                'action' => $action,
                'details' => serialize($details)
            ];

            $transaction_id = DB::table('feathercash_tracker')->insertGetId($values);
            return $transaction_id;
        }else{
            return false;
        }
    }

    public static function updateUserFeatherCash($user_id, $current_amount, $last_transaction_id){
        if(DB::table('feathercash_user')->where('user_id', '=', $user_id)->first()){
            DB::table('feathercash_user')->where('user_id', '=', $user_id)->update(['current_amount' => $current_amount, 'latest_transaction_id' => $last_transaction_id]);
        }else{
            DB::table('feathercash_user')->insert(['user_id' => $user_id, 'current_amount' => $current_amount, 'latest_transaction_id' => $last_transaction_id]);
        }
    }

    public static function getUserFeatherCashAccount($user_id){
        $computed_amount = FeatherCash::getFeatherCashTransactionsComputedAmount($user_id);
        $account = DB::table('feathercash_user')
            ->where('feathercash_user.user_id', '=', $user_id)
            ->select('feathercash_user.current_amount')
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

    public static function getUserFeatherCashTransactions($user_id, $limit = 99){
        return DB::table('feathercash_tracker')->orderBy('transaction_id', 'desc')->where('user_id', '=', $user_id)->take($limit)->get();
    }

    public static function getAddTransactionsTotal($user_id){
        return DB::table('feathercash_tracker')
            ->where('user_id', '=', $user_id)
            ->where('action', '=', 1)
            ->select(DB::raw('SUM(amount) as positive_amount'))
            ->first()
            ->positive_amount;
    }

    public static function getSubtractTransactionsTotal($user_id){
        return DB::table('feathercash_tracker')
            ->where('user_id', '=', $user_id)
            ->where('action', '=', 0)
            ->select(DB::raw('SUM(amount) as negative_amount'))
            ->first()
            ->negative_amount;
    }

    public static function getFeatherCashTransactionsComputedAmount($user_id){
        return FeatherCash::getAddTransactionsTotal($user_id) - FeatherCash::getSubtractTransactionsTotal($user_id);
    }
}