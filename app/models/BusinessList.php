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
        return BusinessList::where('name', 'LIKE', $letter . '%s')->orderBy('name')->skip($offset)->take(10)->get();
    }

}