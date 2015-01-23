<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:32 PM
 */

class TerminalManager extends Eloquent{

    protected $table = 'terminal_manager';
    protected $primaryKey = 'login_id';
    public $timestamps = false;

}