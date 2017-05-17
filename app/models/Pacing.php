<?php

/**
 * Created by PhpStorm.
 * User: Polljii143
 * Date: 5/15/17
 * Time: 4:49 PM
 */
class Pacing extends Eloquent
{
    protected $table = 'pacing';
    protected $primaryKey = 'pacing_id';
    public $timestamps = false;

    public static function addSlots($values = array()) {
        Pacing::insert($values);
    }
}
