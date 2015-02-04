<?php
/**
 * Created by PhpStorm.
 * User: CSD
 * Date: 2/4/2015
 * Time: 4:33 PM
 */

class TerminalUser extends Eloquent{
    protected $table = 'terminal_user';
    protected $primaryKey = 'terminal_user_id';
    public $timestamps = false;
}