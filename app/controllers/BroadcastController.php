<?php
/**
 *
 * Should contain functions related to the broadcast page
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:11 PM
 */

class BroadcastController extends BaseController{

    /*public function getBranch($branch_id = 0)
    {
        $business_id = Branch::businessId($branch_id);
        if (Branch::name($branch_id) == 'Main') {
            $business_name = Business::name($business_id);
        }
        else {
            $business_name = Branch::name($branch_id) . ' > ' . Business::name($business_id);
        }
        $open_time = str_pad(Business::openHour($business_id), 2, 0) . ':' . str_pad(Business::openMinute($business_id), 2, 0) . ' ' . Business::openAMPM($business_id);
        $close_time = str_pad(Business::closeHour($business_id), 2, 0) . ':' . str_pad(Business::closeMinute($business_id), 2, 0) . ' ' . Business::closeAMPM($business_id);
        return View::make('broadcast')
          ->with('open_time', $open_time)
          ->with('close_time', $close_time)
          ->with('local_address', Business::localAddress($business_id))
          ->with('branch_id', $branch_id)
          ->with('lines_in_queue', TerminalTransaction::getTransactionsNotYetCompleted())
          ->with('business_name', $business_name);
    }*/

    /**
     * @author Ruffy
     * @param int $business_id
     * @return mixed
     * @description Adds an option to display the broadcast page by Business
     */
    public function getBusiness($business_id = 0)
    {
        $business_name = Business::name($business_id);
        $open_time = str_pad(Business::openHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::openMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::openAMPM($business_id);
        $close_time = str_pad(Business::closeHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::closeMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::closeAMPM($business_id);

        return View::make('broadcast')
            ->with('open_time', $open_time)
            ->with('close_time', $close_time)
            ->with('local_address', Business::localAddress($business_id))
            ->with('business_id', $business_id) /* RDH Changed error, 'branch_id' to 'business_id' */
            ->with('business_name', $business_name)
            ->with('lines_in_queue', Analytics::getBusinessRemainingCount($business_id))
            ->with('estimate_serving_time', Analytics::getAverageTimeServedByBusinessId($business_id));
    }

    public function getNumbers($branch_id = 0) {
        return file_get_contents(public_path() . '/json/' . $branch_id . '.json');
    }

    public function getServicesCurrentNumber($branch_id){
        $services = PriorityNumber::getBranchServicesActiveQueue($branch_id);
        foreach($services as $key => $service){
            $services[$key] = $this->getServiceKeyDetails($service, $branch_id);
        }
        return $services;
    }

    public function getServiceKeyDetails($service, $branch_id){
        $service->current_number = PriorityQueue::currentNumber($service->service_id, $branch_id);
        $service->last_number_given = PriorityQueue::lastNumberGiven($service->service_id, $branch_id);
        $service->terminals = $this->getTerminalCurrentNumber($service->service_id, $branch_id);
        $service->called_numbers = PriorityQueue::calledNumbers($service->service_id, $branch_id);
        return $service;
    }

  public function getResetNumbers($business_id) {
    date_default_timezone_set("Asia/Manila"); // Manila Timezone for now but this depends on business location
    $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
    if ($data->date != date("mdy")) {
      $data->box1->number = '';
      $data->box1->terminal = '';
      $data->box1->rank = '';
      $data->box2->number = '';
      $data->box2->terminal = '';
      $data->box2->rank = '';
      $data->box3->number = '';
      $data->box3->terminal = '';
      $data->box3->rank = '';
      $data->box4->number = '';
      $data->box4->terminal = '';
      $data->box4->rank = '';
      $data->box5->number = '';
      $data->box5->terminal = '';
      $data->box5->rank = '';
      $data->box6->number = '';
      $data->box6->terminal = '';
      $data->box6->rank = '';
      $data->get_num = '';
      $data->date = date("mdy");
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . $business_id . '.json', $encode);
      return json_encode(array('status' => 1));
    }
    else {
      return json_encode(array('status' => 0));
    }
  }

}