<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:20 PM
 */

class Business extends Eloquent{

    protected $table = 'business';
    protected $primaryKey = 'business_id';
    public $timestamps = false;

    public static function name($business_id){
        return Business::where('business_id', '=', $business_id)->select(array('name'))->first()->name;
    }

    public static function localAddress($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('local_address'))->first()->local_address;
    }

    public static function openHour($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('open_hour'))->first()->open_hour;
    }

    public static function openMinute($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('open_minute'))->first()->open_minute;
    }

    public static function openAMPM($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('open_ampm'))->first()->open_ampm;
    }

    public static function closeHour($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('close_hour'))->first()->close_hour;
    }

    public static function closeMinute($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('close_minute'))->first()->close_minute;
    }

    public static function closeAMPM($business_id)
    {
        return Business::where('business_id', '=', $business_id)->select(array('close_ampm'))->first()->close_ampm;
    }

    /** functions to get the Business name **/
    public static function getBusinessNameByTerminalId($terminal_id){
        return Business::getBusinessNameByServiceId(Terminal::serviceId($terminal_id));
    }

    public static function getBusinessNameByServiceId($service_id){
        return Business::getBusinessNameByBranchId(Service::branchId($service_id));
    }

    public static function getBusinessNameByBranchId($branch_id){
        return Business::name(Branch::businessId($branch_id));
    }
}