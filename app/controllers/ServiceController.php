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

    public function getKioskServices($business_id) {
        $business_services = [];
        $service_terminals = [];
        $branches = Branch::getBranchesByBusinessId($business_id);
        foreach($branches as $branch){
            $services = Service::getServicesByBranchId($branch->branch_id);
            foreach ($services as $key=>$service) {
                $terminals = Terminal::getTerminalsByServiceId($service->service_id);
                $first_terminal = $terminals[0]['name'];
                $service['first_terminal'] = $first_terminal;
                array_push($service_terminals, $terminals);
            }
            array_push($business_services, $services);
        }
        return json_encode(['business_services' => $business_services, 'terminals' => $service_terminals]);
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
//        if(Service::businessServiceNameExists(Input::get('name'), Input::get('business_id'))){
//            return json_encode(['error' => 'Service name already exists']);
//        }else{
            $service_id = Service::createBusinessService(Input::get('business_id'), Input::get('name'), Input::get('group_id'));
            return json_encode(['service_id' => $service_id]);
//        }
    }

    //update service
    public function putIndex($service_id){
//        if(Service::serviceNameExists(Input::get('name'), $service_id)){
//            return json_encode(['error' => 'Service name already exists']);
//        }else{
            Service::updateServiceName($service_id, Input::get('name'));
            return json_encode(['success' => 1]);
//        }
    }

    //delete service
    public function deleteIndex($service_id){
        $terminals = Terminal::getTerminalsByServiceId($service_id);
        $delete = true;
        foreach($terminals as $terminal){
            $delete = TerminalTransaction::terminalActiveNumbers($terminal['terminal_id']) == 0 ? $delete : false;
        }

        if($delete){
            Service::deleteService($service_id);
            return json_encode(['success' => 1]);
        }else{
            return json_encode(['error' => 'There are still active numbers for this service.']);
        }
    }

    public function postUpdateGroup(){
        return Service::updateGroup(Input::get('service_id'), Grouping::findIdByGroupName(Input::get('group_name')));
    }

    public function getServiceByGroup($group_id){
        return Service::getServicesByGroup($group_id);
    }
//    public function getKioskList($business_id) {
//        $business_services = [];
//        $business_terminals = [];
//        $branches = Branch::getBranchesByBusinessId($business_id);
//        foreach($branches as $branch){
//            $services = Service::getServicesByBranchId($branch->branch_id);
//            array_push($business_services, $services);
//            foreach ($services as $service_instance) {
//                $terminals = Terminal::getTerminalsByServiceId($service_instance->service_id);
//                array_push($business_terminals, $terminals);
//            }
//        }
//        return json_encode(['business_services' => $business_services, 'business_terminals' => $business_terminals]);
//    }

}