<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:21 PM
 */

class PriorityQueue extends Eloquent {

    protected $table = 'priority_queue';
    protected $primaryKey = 'transaction_number';
    public $timestamps = false;

}