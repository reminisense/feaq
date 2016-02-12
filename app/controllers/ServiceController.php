<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 12/1/2015
 * Time: 12:53 PM
 */

class ServiceController extends Controller{

    public function getBusiness($business_id){
        $business_services = [];
        $branches = Branch::getBranchesByBusinessId($business_id);
        foreach($branches as $branch){
            $services = Service::getServicesByBranchId($branch->branch_id);
            array_push($business_services, $services);
        }
        return json_encode(['business_services' => $business_services]);
    }

    //get services
    //not used by business
    public function getIndex($service_id = null){
        if($service_id){
            $service = Service::find($service_id);
            $services = [$service];
        }else{
            $services = Service::all();
        }
        return json_encode(['services' => $services]);
    }

    //create service
    public function postIndex(){
        $service_id = Service::createBusinessService(Input::get('business_id'), Input::get('name'));
        return json_encode(['service_id' => $service_id]);
    }

    //update service
    public function putIndex($service_id){
        if(Service::branchServiceNameExists(Input::get('name'), $service_id)){
            return json_encode(['error' => 'Service name already exists']);
        }else{
            Service::updateServiceName($service_id, Input::get('name'));
            return json_encode(['success' => 1]);
        }
    }

    //delete service
    public function deleteIndex($service_id){
        Service::deleteService($service_id);
        return json_encode(['success' => 1]);
    }

}