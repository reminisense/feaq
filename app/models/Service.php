<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:21 PM
 */

class Service extends Eloquent{

    protected $table = 'service';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    public static function branchId($service_id){
        return Service::find($service_id)->branch_id;
    }

}