<?php

/**
 * Created by PhpStorm.
 * User: Polljii143
 * Date: 5/14/17
 * Time: 4:01 PM
 */
class Pacing
{
    protected $table = 'pacing';
    protected $primaryKey = 'pacing_id';
    public $timestamps = false;

    public static function addSchedule($value = array())
    {
        Pacing::insert($value);
    }

    public static function fetchSchedules()
    {
        return Pacing::all();
    }
}