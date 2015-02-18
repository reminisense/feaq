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
        $business = Business::where('business_id', '=', $business_id)->get()->first();
        $terminals = Terminal::getTerminalsByBusinessId($business_id);
        $terminals = Terminal::getAssignedTerminalWithUsers($terminals);
        $business_details = [
            'business_id' => $business_id,
            'business_name' => $business->name,
            'business_address' => $business->local_address,
            'facebook_url' => $business->fb_url,
            'industry' => $business->industry,
            'time_open' => Helper::mergeTime($business->open_hour, $business->open_minute, $business->open_ampm),
            'time_closed' => Helper::mergeTime($business->close_hour, $business->close_minute, $business->close_ampm),
            'queue_limit' => $business->queue_limit, /* RDH Added queue_limit to Edit Business Page */
            //'description' =>
            'terminals' => $terminals
        ];

        return $business_details;
    }
    
    /*
     * @author: CSD
     * @description: fetch business row by business id
     * @return business row with all branches, services and terminals
     */
    public static function getBusinessArray($business_id){
        $business = Business::where('business_id', '=', $business_id)->get()->first();
        $branches = [];
        $services = [];
        $terminals = [];
        $rawBranches = Branch::getBranchesByBusinessId($business->business_id);

        foreach($rawBranches as $branch){
            array_push($branches, $branch);
            $rawServices = Service::getServicesByBranchId($branch->branch_id);

            foreach($rawServices as $service){
                array_push($services, $service);

                $rawTerminals = Terminal::getTerminalsByServiceId($service->service_id);

                /* get terminal id's of assigned terminals */
                $terminalAssignments = TerminalUser::getTerminalAssignement(Auth::user()->user_id);
                $terminalIds = [];
                foreach($terminalAssignments as $assignment){
                    array_push($terminalIds, $assignment['terminal_id']);
                }
                /* end */

                foreach($rawTerminals as $terminal) {
                    if (in_array($terminal['terminal_id'], $terminalIds)){
                        $terminal['status'] = 1;
                    }
                    array_push($terminals, $terminal);
                }
            }
        }

        $business->branches = $branches;
        $business->services = $services;
        $business->terminals = $terminals;

        return $business;
    }

    public static function getBusinessByNameCountryIndustryTimeopen($name, $country, $industry, $time_open = NULL) {
        if ($time_open) {
            $time_open_arr = Helper::parseTime($time_open);
        }
        else {
            $time_open_arr['hour'] = '';
            $time_open_arr['min'] = '';
            $time_open_arr['ampm'] = '';
        }
        if ($country == 'Location') {
            $country = '';
        }
        if ($industry == 'Industry') {
            $industry = '';
        }
        if ($time_open_arr['ampm'] == 'PM' && $time_open_arr['min'] == '00') {
            return Business::where('name', 'LIKE', '%' . $name . '%')
              ->where('local_address', 'LIKE', '%' . $country . '%')
              ->where('industry', 'LIKE', '%' . $industry . '%')
              ->where('open_ampm', '=', 'PM')
              ->where('open_hour', '>=', $time_open_arr['hour'])
              ->get();
        }
        elseif ($time_open_arr['ampm'] == 'PM' && $time_open_arr['min'] == '30') {
            return Business::where('name', 'LIKE', '%' . $name . '%')
              ->where('local_address', 'LIKE', '%' . $country . '%')
              ->where('industry', 'LIKE', '%' . $industry . '%')
              ->where('open_ampm', '=', 'PM')
              ->whereRaw('open_hour > ? OR (open_hour = ? AND open_minute = ?)',
                array($time_open_arr['hour'], $time_open_arr['hour'], '30'))
              ->get();
        }
        elseif ($time_open_arr['ampm'] == 'AM' && $time_open_arr['min'] == '00') {
            return Business::where('name', 'LIKE', '%' . $name . '%')
              ->where('local_address', 'LIKE', '%' . $country . '%')
              ->where('industry', 'LIKE', '%' . $industry . '%')
              ->whereRaw('(open_hour >= ? AND open_ampm = ?) OR (open_hour < ? AND open_ampm = ?)',
                  array($time_open_arr['hour'], 'AM', $time_open_arr['hour'], 'PM'))
              ->get();
        }
        elseif ($time_open_arr['ampm'] == 'AM' && $time_open_arr['min'] == '30') {
            return Business::where('name', 'LIKE', '%' . $name . '%')
              ->where('local_address', 'LIKE', '%' . $country . '%')
              ->where('industry', 'LIKE', '%' . $industry . '%')
              ->whereRaw('(open_hour > ? AND open_ampm = ?) OR (open_hour < ? AND open_ampm = ?) OR (open_hour = ? AND open_minute = ? AND open_ampm = ?)',
                array($time_open_arr['hour'], 'AM', $time_open_arr['hour'], 'PM', $time_open_arr['hour'], '30', 'AM'))
              ->get();
        }
        else {
            return Business::where('name', 'LIKE', '%' . $name . '%')
              ->where('local_address', 'LIKE', '%' . $country . '%')
              ->where('industry', 'LIKE', '%' . $industry . '%')
              ->get();
        }
    }

  public static function deleteBusinessByBusinessId($business_id) {
    Business::where('business_id', '=', $business_id)->delete();
  }
}