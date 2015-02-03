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

    public static function getBusinessIdByTerminalId($terminal_id){
        return Business::getBusinessIdByServiceId(Terminal::serviceId($terminal_id));
    }

    public static function getBusinessIdByServiceId($service_id){
        return Branch::businessId(Service::branchId($service_id));
    }

    public static function getBusinessDetails($business_id){
        $business = Business::find($business_id)->first();
        $terminals = Terminal::getTerminalsByBusinessId($business_id);
        $terminals = Terminal::getAssignedTerminalWithUsers($terminals);
        $business_details = [
            'business_id' => $business_id,
            'business_name' => $business->name,
            'business_address' => $business->local_address,
            //'facebook_url' => $business->face,
            'industry' => $business->industry,
            'time_open' => Helper::mergeTime($business->open_hour, $business->open_minute, $business->open_ampm),
            'time_closed' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
            //'description' =>
            'terminals' => $terminals
        ];

        return $business_details;
    }
}