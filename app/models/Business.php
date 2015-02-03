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

                foreach($rawTerminals as $terminal) {
                    array_push($terminals, $terminal);
                }

            }
        }

        $business->branches = $branches;
        $business->services = $services;
        $business->terminals = $terminals;

        return $business;
    }
}