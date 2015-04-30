<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 4/28/15
 * Time: 3:21 PM
 */

class ViewHistory extends Eloquent{
    protected $table = 'watchdog';
    protected $primaryKey = 'log_id';

    public static function addViewHistory($data){
        return ViewHistory::insertGetId($data);
    }
}