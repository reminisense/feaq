<?php

/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:21 PM
 */
class Service extends Eloquent
{

    protected $table = 'service';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    public static function branchId($service_id)
    {
        return Service::find($service_id)->branch_id;
    }

    public static function name($sevice_id)
    {
        return Service::find($sevice_id)->name;
    }

    public static function getServiceNameByTerminalId($terminal_id)
    {
        return Service::name(Terminal::serviceId($terminal_id));
    }

    /*
     * @author: ARA
     * @description: create new service
     * @return service_id
     */
    public static function createService($branch_id, $name)
    {
        $service = new Service();
        $service->name = $name;
        $service->status = 1;
        $service->branch_id = $branch_id;
        $service->save();
        Helper::dbLogger('Service', 'service', 'insert', 'createService', User::email(Helper::userId()),
          'service_id:' . $service->service_id . ', service_name:' . $name);
        return $service->service_id;
    }

    /*
     * @author: ARA
     * @description: create new service for business
     * @return service_id
     */
    public static function createBusinessService($business_id, $name)
    {
        $first_branch = Branch::getFirstBranchOfBusiness($business_id);
        return Service::createService($first_branch->branch_id, $name);
    }

    /*
     * @author: CSD
     * @description: create branch on business creation/setup
     * @return service_id
     */
    public static function createBranchService($branch_id, $business_name)
    {
        return Service::createService($branch_id, $business_name . " Service"); //ARA Moved function to createService
    }

    /*
     * @author ARA
     * @description get services based on business id
     * @
     */
    public static function getServicesByBusinessId($business_id)
    {
        return Service::join('branch', 'service.branch_id', '=', 'branch.branch_id')
          ->join('grouping', 'service.group_id', '=', 'grouping.group_id')
          ->where('branch.business_id', '=', $business_id)
          ->select('service.service_id', 'service.branch_id', 'branch.business_id', 'service.name', 'service.group_id',
            'grouping.group_name')
          ->get();
    }

    public static function getBusinessServicesWithTerminals($business_id)
    {
        $services = Service::getServicesByBusinessId($business_id);
        foreach ($services as $service) {
            $terminals = Terminal::getTerminalsByServiceId($service->service_id);
            $service->terminals = Terminal::getAssignedTerminalWithUsers($terminals);
        }
        return $services;
    }

    /*
     * @author: CSD
     * @description: fetch services by branch id
     * @return services array of branch
     */
    public static function getServicesByBranchId($branch_id)
    {
        return Service::where('branch_id', '=', $branch_id)->get();
    }

    public static function deleteServicesByBranchId($branch_id)
    {
        Helper::dbLogger('Service', 'service', 'delete', 'deleteServicesByBranchId', User::email(Helper::userId()),
          'branch_id:' . $branch_id);
        return Service::where('branch_id', '=', $branch_id)->delete();
    }

    public static function getFirstServiceOfBusiness($business_id)
    {
        $first_branch = Branch::getFirstBranchOfBusiness($business_id);
        return Service::getFirstServiceOfBranch($first_branch->branch_id);
    }

    public static function getFirstServiceOfBranch($branch_id)
    {
        return Service::where('branch_id', '=', $branch_id)->first();
    }

    public static function updateServiceName($service_id, $name)
    {
        Service::where('service_id', '=', $service_id)->update(['name' => $name]);
        Helper::dbLogger('Service', 'service', 'update', 'updateServiceName', User::email(Helper::userId()),
          'service_id:' . $service_id);
    }

    public static function deleteService($service_id)
    {
        $terminals = Terminal::getTerminalsByServiceId($service_id);
        foreach ($terminals as $terminal) {
            Terminal::deleteTerminal($terminal['terminal_id'], Helper::userId());
        }
        Service::where('service_id', '=', $service_id)->delete();
        Helper::dbLogger('Service', 'service', 'delete', 'deleteService', User::email(Helper::userId()),
          'service_id:' . $service_id);
    }

    public static function serviceNameExists($name, $service_id)
    {
        $branch_id = Service::branchId($service_id);
        return Service::branchServiceNameExists($name, $branch_id);
//        return FALSE;
    }

    public static function branchServiceNameExists($name, $branch_id)
    {
        return Service::where('name', '=', $name)->where('branch_id', '=', $branch_id)->exists();
    }

    public static function businessServiceNameExists($name, $business_id)
    {
        return Service::join('branch', 'branch.branch_id', '=', 'service.branch_id')
          ->join('business', 'business.business_id', '=', 'branch.business_id')
          ->where('service.name', '=', $name)
          ->where('business.business_id', '=', $business_id)
          ->exists();
//        return FALSE;
    }

    public static function getServicesByGroup($group_id)
    {
        return Service::where('group_id', '=', $group_id)->get();
    }

    public static function getGroupIdByService($service_id)
    {
        return Service::where('service_id', '=', $service_id)->first()->group_id;
    }

    public static function updateGroup($service_id, $group_id)
    {
        Service::where('service_id', '=', $service_id)->update(array('group_id' => $group_id));
    }

}