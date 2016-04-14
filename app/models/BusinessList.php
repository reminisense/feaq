<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 4/6/2016
 * Time: 10:47 AM
 */

class BusinessList extends Eloquent
{

    protected $table = 'business_list';
    protected $primaryKey = 'business_list_id';
    public $timestamps = true;

    public static function fetchBusinessByLetterOffset($letter = "", $offset = 0) {
        return BusinessList::where('name', 'LIKE', $letter . '%')->orderBy('name')->skip($offset)->take(20)->get();
    }

    public static function fetchAllBusinessByOffset($offset = 0) {
        return BusinessList::orderBy('name')->skip($offset)->take(20)->get();
    }

    public static function updateUpvoteById($business_list_id) {
        $up_vote = BusinessList::getUpvoteById($business_list_id) + 1;
        BusinessList::where('business_list_id', '=', $business_list_id)->update(array('up_vote' => $up_vote));
    }

    public static function getUpvoteById($business_list_id) {
        return BusinessList::where('business_list_id', '=', $business_list_id)->select(array('up_vote'))->first()->up_vote;
    }

}