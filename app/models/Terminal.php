<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:22 PM
 */

class Terminal extends Eloquent{

    protected $table = 'terminal';
    protected $primaryKey = 'terminal_id';
    public $timestamps = false;

    public static function name($terminal_id){
        return Terminal::find($terminal_id)->name;
    }

    public static function serviceId($terminal_id){
        return Terminal::find($terminal_id)->service_id;
    }

}