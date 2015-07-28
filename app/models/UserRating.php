<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 4/28/2015
 * Time: 3:53 PM
 */

class UserRating extends Eloquent{

    protected $table = 'user_rating';
    protected $primaryKey = 'user_rating_id';
    public $timestamps = false;


    public static function rateUser($date, $business_id, $rating, $user_id, $terminal_user_id, $action){

        $data= [
            'business_id' => $business_id,
            'rating' => $rating,
            'user_id' => $user_id,
            'terminal_user_id' => $terminal_user_id,
            'action' => $action,
            'date' => $date
        ];

        UserRating::saveRatingUser($data);

    }

    public static function rateBusiness($date, $business_id, $rating, $user_id, $terminal_user_id, $action, $transaction_number){

        $data= [
            'business_id' => $business_id,
            'rating' => $rating,
            'user_id' => $user_id,
            'terminal_user_id' => $terminal_user_id,
            'action' => $action,
            'date' => $date,
            'transaction_number' => $transaction_number,
        ];

        UserRating::saveRatingUser($data);

    }

    public static function saveRatingUser($data){
        DB::table('user_rating')->insert($data);
    }
}