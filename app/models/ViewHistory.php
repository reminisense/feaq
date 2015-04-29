<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 4/28/15
 * Time: 3:21 PM
 */

class ViewHistory extends Eloquent{
    protected $table = 'view_history';
    protected $primaryKey = 'view_history_id';

    public static function addViewHistory($data){
        return ViewHistory::insertGetId($data);
    }
}