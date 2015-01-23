<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:21 PM
 */

class Branch extends Eloquent{

    protected $table = 'branch';
    protected $primaryKey = 'branch_id';
    public $timestamps = false;

}