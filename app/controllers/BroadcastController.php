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

    // The redirection code if ever the user visits the generic url
    public function getBusiness($business_id = 0)
    {
      return Redirect::to('/' . Business::getRawCodeByBusinessId($business_id));
    }

    // The broadcast rendering function
    public function viewBroadcastPage($raw_code = '') {
      if (Business::businessWithVanityURLExists($raw_code)) {
        $business_id = Business::getBusinessIdByVanityURL($raw_code);
        $custom_url = $raw_code;
      }
      else {
        $business_id = Business::getBusinessIdByRawCode($raw_code);
        $vanity_url = Business::getVanityURLByRawCode($raw_code);
        if ($vanity_url) {
          return Redirect::to('/' . $vanity_url);
        }
        $custom_url = $raw_code;
      }
      $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
      $ad_src = $this->fetchAdSource($data->ad_type, $business_id, $data->tv_channel);
      $business_name = Business::name($business_id);
      $open_time = str_pad(Business::openHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::openMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::openAMPM($business_id);
      $close_time = str_pad(Business::closeHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::closeMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::closeAMPM($business_id);
      $first_service = Service::getFirstServiceOfBusiness($business_id);
      $allow_remote = QueueSettings::allowRemote($first_service->service_id);
      $ticker_message = $this->tickerPusher($data->ticker_message, $data->ticker_message2, $data->ticker_message3, $data->ticker_message4, $data->ticker_message5);
      $templates = $this->broadcastTemplate($data->display, $business_id);
      $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
      $regions = $this->broadcastRegionsClassName($data->adspace_size, $data->numspace_size);
      $ad_class = $regions['ad_class'];
      $num_class = $regions['num_class'];
      $numboxes = $this->numBoxesClassName($data->display, $regions['percentage']);
      $row_class = $numboxes['row_class'];
      $box_class = $numboxes['box_class'];
      return View::make($templates['broadcast_template'])
        //->with('custom_fields', $custom_fields)
        //->with('template_type', $data->d)
        ->with('ticker_width', 100 - $regions['percentage'])
        ->with('custom_url', $custom_url)
        ->with('adspace_size', $data->adspace_size)
        ->with('carousel_delay', isset($data->carousel_delay) ? (int)$data->carousel_delay : 5000)
        ->with('ad_type', $data->ad_type)
        ->with('ad_src', $ad_src)
        ->with('box_num', explode("-", $data->display)[1]) // the second index tells how many numbers to show in the broadcast screen
        ->with('broadcast_type', $templates['broadcast_type'])
        ->with('open_time', $open_time)
        ->with('close_time', $close_time)
        ->with('local_address', Business::localAddress($business_id))
        ->with('business_id', $business_id) /* RDH Changed error, 'branch_id' to 'business_id' */
        ->with('business_name', $business_name)
        ->with('lines_in_queue', Analytics::getBusinessRemainingCount($business_id))
        ->with('estimate_serving_time', Analytics::getAverageTimeServedByBusinessId($business_id, 'string', $date, $date))
        ->with('first_service', Service::getFirstServiceOfBusiness($business_id))
        ->with('allow_remote', $allow_remote)
        ->with('ticker_message', $ticker_message)
        ->with('ad_class', $ad_class)
        ->with('num_class', $num_class)
        ->with('row_class', $row_class)
        ->with('box_class', $box_class)
        ->with('user', Auth::user())
        ->with('keywords', Business::getKeywordsByBusinessId($business_id));
    }

    // set the appropriate responsive class names
    private function numBoxesClassName($display, $percentage) {
      $row_class = '';
      $box_class = '';
      if ($display == '1-4' || $display == '2-4') {
        if ($percentage <= 40) {
          $row_class = 'row-4';
          $box_class = 'col-1';
        }
        else {
          $row_class = 'row-2';
          $box_class = 'col-2';
        }
      }
      elseif ($display == '1-5' || $display == '2-5') {
        if ($percentage <= 40) {
          $row_class = 'row-5';
          $box_class = 'col-1';
        }
        else {
          $row_class = 'row-3';
          $box_class = 'col-2';
        }
      }
      return array('row_class' => $row_class, 'box_class' => $box_class);
    }

    // check if the ad area is 50, 40, or 30 percent and apply the appropriate class name
    private function broadcastRegionsClassName($adspace_size, $numspace_size) {
      $ad_area = str_replace('px', '', $adspace_size);
      $num_area = str_replace('px', '', $numspace_size);
      $percentage = $num_area / ($ad_area + $num_area) * 100;
      $percentage = round($percentage, -1);
      if ($percentage == '40') {
        $ad_class = 'sixty';
        $num_class = 'forty';
      }
      elseif ($percentage <= 30) {
        $ad_class = 'seventy';
        $num_class = 'thirty';
        $percentage = 30;
      }
      else {
        $ad_class = 'fifty fifty-a';
        $num_class = 'fifty fifty-b';
      }
      return array('ad_class' => $ad_class, 'num_class' => $num_class, 'percentage' => $percentage);
    }

    // This function fetches the appropriate ad source by checking the type of advertisement.
    private function fetchAdSource($ad_type, $business_id, $tv_channel = '') {
      if ($ad_type == 'image' || $ad_type == 'carousel') {
        $ad_src = array();
        $res = AdImages::getAllImagesByBusinessId($business_id);
        foreach ($res as $count => $img) {
          $ad_src[] = $img->path;
        }
      }
      else {
        if (Helper::isBusinessOwner($business_id, Helper::userId())) {
          $ad_src = $tv_channel;
        }
        else { // non business users are just shown ad images instead of tv for bandwidth purposes
          $ad_src = array();
          $res = AdImages::getAllImagesByBusinessId($business_id);
          foreach ($res as $count => $img) {
            $ad_src[] = $img->path;
          }
        }
      }
      return $ad_src;
    }

    // This function pushes the ticker messages into an array for rendering.
    private function tickerPusher($ticker_message, $ticker_message2, $ticker_message3, $ticker_message4, $ticker_message5) {
      $arr = array();
      array_push($arr, $ticker_message);
      array_push($arr, $ticker_message2);
      array_push($arr, $ticker_message3);
      array_push($arr, $ticker_message4);
      array_push($arr, $ticker_message5);
      return $arr;
    }

  // This function will replace the TV template to a regular ad if the broadcast screen is not business type.
  private function replaceTVtoAdsTemplate($arr, $business_id) {
    if ($arr[0] == '2') {
      if (Helper::isBusinessOwner($business_id, Helper::userId())) {
        return '2-' . $arr[1];
      }
      return '1-' . $arr[1];
    }
    else {
      return $arr[0] . '-' . $arr[1];
    }
  }

    // This function determines the master template of the broadcast screen depending on the type of advertisement.
    private function broadcastTemplate($display, $business_id) {
      $arr = explode("-", $display);
      if (Helper::isBusinessOwner($business_id, Helper::userId())) {
        $broadcast_template = 'broadcast.default.business-master';
      }
      else { // anonymous and non business users should view only the public broadcast screen
        $broadcast_template = 'broadcast.default.public-master';
      }
      $broadcast_type = $this->replaceTVtoAdsTemplate($arr, $business_id);
      return array('broadcast_template' => $broadcast_template, 'broadcast_type' => $broadcast_type);
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

  public function postSaveSettings() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) {
      $data = json_decode(file_get_contents(public_path() . '/json/' . Input::get('business_id') . '.json'));
      $data->adspace_size = Input::get('adspace_size');
      $data->numspace_size = Input::get('numspace_size');
      $data->ad_type = Input::get('ad_type');
      $data->carousel_delay = Input::get('carousel_delay') * 1000; // convert from second to millisecond
      if ($data->ad_type == 'internet_tv') {
        $data->tv_channel = Input::get('tv_channel');
      }
      $data->display = $this->generateDisplayCode($data->ad_type, Input::get('num_boxes'));
      $data->show_issued = Input::get('show_issued');
      $data->show_names = Input::get('show_names');
      $data->ticker_message = Input::get('ticker_message');
      $data->ticker_message2 = Input::get('ticker_message2');
      $data->ticker_message3 = Input::get('ticker_message3');
      $data->ticker_message4 = Input::get('ticker_message4');
      $data->ticker_message5 = Input::get('ticker_message5');
      $data = $this->boxObjectCreator($data, Input::get('num_boxes'));
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . Input::get('business_id') . '.json', $encode);
      // print_r(Input::get('terminal_colors'));
      foreach (Input::get('terminal_colors') as $count => $terminal_data) {
        Terminal::setColor($terminal_data["color_value"], $terminal_data["terminal_id"]);
      }
      return json_encode(array('status' => 1));
    }
    else {
      return json_encode(array('status' => 0));
    }
  }

  // generate a representation for the combination of ad_type and num_boxes
  private function generateDisplayCode($ad_type, $num_boxes) {
    if ($ad_type == 'carousel') {
      $display = '1-';
    }
    elseif ($ad_type == 'internet_tv') {
      $display = '2-';
    }
    else {
      $display = '0-';
    }
    return $display . $num_boxes;
  }

  private function boxObjectCreator($data, $num_boxes) {
    if ($num_boxes >= '2') {
      $data->box2 = new stdClass();
      $data->box2->number = '';
      $data->box2->terminal = '';
      $data->box2->rank = '';
      $data->box2->service = '';
      $data->box2->color = '';
    }
    if ($num_boxes >= '3') {
      $data->box3 = new stdClass();
      $data->box3->number = '';
      $data->box3->terminal = '';
      $data->box3->rank = '';
      $data->box3->service = '';
      $data->box3->color = '';
    }
    if ($num_boxes >= '4') {
      $data->box4 = new stdClass();
      $data->box4->number = '';
      $data->box4->terminal = '';
      $data->box4->rank = '';
      $data->box4->service = '';
      $data->box4->color = '';
    }
    if ($num_boxes >= '5') {
      $data->box5 = new stdClass();
      $data->box5->number = '';
      $data->box5->terminal = '';
      $data->box5->rank = '';
      $data->box5->service = '';
      $data->box5->color = '';
    }
    if ($num_boxes >= '6') {
      $data->box6 = new stdClass();
      $data->box6->number = '';
      $data->box6->terminal = '';
      $data->box6->rank = '';
      $data->box6->service = '';
      $data->box6->color = '';
    }
    if ($num_boxes >= '7') {
      $data->box7 = new stdClass();
      $data->box7->number = '';
      $data->box7->terminal = '';
      $data->box7->rank = '';
      $data->box7->service = '';
      $data->box7->color = '';
    }
    if ($num_boxes >= '8') {
      $data->box8 = new stdClass();
      $data->box8->number = '';
      $data->box8->terminal = '';
      $data->box8->rank = '';
      $data->box8->service = '';
      $data->box8->color = '';
    }
    if ($num_boxes >= '9') {
      $data->box9 = new stdClass();
      $data->box9->number = '';
      $data->box9->terminal = '';
      $data->box9->rank = '';
      $data->box9->service = '';
      $data->box9->color = '';
    }
    if ($num_boxes == '10') {
      $data->box10 = new stdClass();
      $data->box10->number = '';
      $data->box10->terminal = '';
      $data->box10->rank = '';
      $data->box10->service = '';
      $data->box10->color = '';
    }
    $data = $this->boxObjectUnsetter($data, $num_boxes);
    return $data;
  }

  private function boxObjectUnsetter($data, $num_boxes) {
    if ($num_boxes == '1') {
      unset($data->box2);
      unset($data->box3);
      unset($data->box4);
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '2') {
      unset($data->box3);
      unset($data->box4);
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '3') {
      unset($data->box4);
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '4') {
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '5') {
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '6') {
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '7') {
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '8') {
      unset($data->box9);
      unset($data->box10);
    }
    elseif ($num_boxes == '9') {
      unset($data->box10);
    }
    return $data;
  }

  public function getResetNumbers($business_id) {
    if (Helper::isBusinessOwner($business_id, Helper::userId())) {
      date_default_timezone_set("Asia/Manila"); // Manila Timezone for now but this depends on business location
      $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
      if ($data->date != date("mdy")) {
        $data->box1->number = '';
        $data->box1->terminal = '';
        $data->box1->rank = '';
        $data->box1->service = '';
        $data->box1->color = '';
        if (isset($data->box2)) {
          $data->box2->number = '';
          $data->box2->terminal = '';
          $data->box2->rank = '';
          $data->box2->service = '';
          $data->box2->color = '';
        }
        if (isset($data->box3)) {
          $data->box3->number = '';
          $data->box3->terminal = '';
          $data->box3->rank = '';
          $data->box3->service = '';
          $data->box3->color = '';
        }
        if (isset($data->box4)) {
          $data->box4->number = '';
          $data->box4->terminal = '';
          $data->box4->rank = '';
          $data->box4->service = '';
          $data->box4->color = '';
        }
        if (isset($data->box5)) {
          $data->box5->number = '';
          $data->box5->terminal = '';
          $data->box5->rank = '';
          $data->box5->service = '';
          $data->box5->color = '';
        }
        if (isset($data->box6)) {
          $data->box6->number = '';
          $data->box6->terminal = '';
          $data->box6->rank = '';
          $data->box6->service = '';
          $data->box6->color = '';
        }
        if (isset($data->box7)) {
          $data->box7->number = '';
          $data->box7->terminal = '';
          $data->box7->rank = '';
          $data->box7->service = '';
          $data->box7->color = '';
        }
        if (isset($data->box8)) {
          $data->box8->number = '';
          $data->box8->terminal = '';
          $data->box8->rank = '';
          $data->box8->service = '';
          $data->box8->color = '';
        }
        if (isset($data->box9)) {
          $data->box9->number = '';
          $data->box9->terminal = '';
          $data->box9->rank = '';
          $data->box9->service = '';
          $data->box9->color = '';
        }
        if (isset($data->box10)) {
          $data->box10->number = '';
          $data->box10->terminal = '';
          $data->box10->rank = '';
          $data->box10->service = '';
          $data->box10->color = '';
        }
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
    else {
      return json_encode(array('status' => 0));
    }
  }

  public function postClearNumbers() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) {
      $data = json_decode(file_get_contents(public_path() . '/json/' . Input::get('business_id') . '.json'));
      $data->box1->number = '';
      $data->box1->terminal = '';
      $data->box1->rank = '';
      $data->box1->service = '';
      $data->box1->color = '';
      if (isset($data->box2)) {
        $data->box2->number = '';
        $data->box2->terminal = '';
        $data->box2->rank = '';
        $data->box2->service = '';
        $data->box2->color = '';
      }
      if (isset($data->box3)) {
        $data->box3->number = '';
        $data->box3->terminal = '';
        $data->box3->rank = '';
        $data->box3->service = '';
        $data->box3->color = '';
      }
      if (isset($data->box4)) {
        $data->box4->number = '';
        $data->box4->terminal = '';
        $data->box4->rank = '';
        $data->box4->service = '';
        $data->box4->color = '';
      }
      if (isset($data->box5)) {
        $data->box5->number = '';
        $data->box5->terminal = '';
        $data->box5->rank = '';
        $data->box5->service = '';
        $data->box5->color = '';
      }
      if (isset($data->box6)) {
        $data->box6->number = '';
        $data->box6->terminal = '';
        $data->box6->rank = '';
        $data->box6->service = '';
        $data->box6->color = '';
      }
      if (isset($data->box7)) {
        $data->box7->number = '';
        $data->box7->terminal = '';
        $data->box7->rank = '';
        $data->box7->service = '';
        $data->box7->color = '';
      }
      if (isset($data->box8)) {
        $data->box8->number = '';
        $data->box8->terminal = '';
        $data->box8->rank = '';
        $data->box8->service = '';
        $data->box8->color = '';
      }
      if (isset($data->box9)) {
        $data->box9->number = '';
        $data->box9->terminal = '';
        $data->box9->rank = '';
        $data->box9->service = '';
        $data->box9->color = '';
      }
      if (isset($data->box10)) {
        $data->box10->number = '';
        $data->box10->terminal = '';
        $data->box10->rank = '';
        $data->box10->service = '';
        $data->box10->color = '';
      }
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . Input::get('business_id') . '.json', $encode);
      return json_encode(array('status' => 1));
    }
    else {
      return json_encode(array('status' => 0));
    }
  }

  /*
  public function postSetTheme() {
    $post = json_decode(file_get_contents("php://input"));
    if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
      $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
      $data->show_issued = $post->show_issued;
      $data->display = $post->theme_type;
      if (strstr($post->theme_type, '-1')) {
        unset($data->box2);
        unset($data->box3);
        unset($data->box4);
        unset($data->box5);
        unset($data->box6);
      }
      elseif (strstr($post->theme_type, '-4')) {
        if (!isset($data->box2)) {
          $data->box2 = new stdClass();
          $data->box2->number = '';
          $data->box2->terminal = '';
          $data->box2->rank = '';
        }
        if (!isset($data->box3)) {
          $data->box3 = new stdClass();
          $data->box3->number = '';
          $data->box3->terminal = '';
          $data->box3->rank = '';
        }
        if (!isset($data->box4)) {
          $data->box4 = new stdClass();
          $data->box4->number = '';
          $data->box4->terminal = '';
          $data->box4->rank = '';
        }
        unset($data->box5);
        unset($data->box6);
      }
      elseif (strstr($post->theme_type, '-6')) {
        if (!isset($data->box2)) {
          $data->box2 = new stdClass();
          $data->box2->number = '';
          $data->box2->terminal = '';
          $data->box2->rank = '';
        }
        if (!isset($data->box3)) {
          $data->box3 = new stdClass();
          $data->box3->number = '';
          $data->box3->terminal = '';
          $data->box3->rank = '';
        }
        if (!isset($data->box4)) {
          $data->box4 = new stdClass();
          $data->box4->number = '';
          $data->box4->terminal = '';
          $data->box4->rank = '';
        }
        if (!isset($data->box5)) {
          $data->box5 = new stdClass();
          $data->box5->number = '';
          $data->box5->terminal = '';
          $data->box5->rank = '';
        }
        if (!isset($data->box6)) {
          $data->box6 = new stdClass();
          $data->box6->number = '';
          $data->box6->terminal = '';
          $data->box6->rank = '';
        }
      }
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . $post->business_id . '.json', $encode);
      return json_encode(array('status' => 1));
    }
    else {
      return json_encode(array('status' => 0, 'message' => 'You are not allowed to access this function.'));
    }
  }
  */

  public function getJsonFixer() {
    $res = Business::all();
    foreach ($res as $count => $business) {
      $business_id = $business->business_id;
      //$data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
      $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
      if (!isset($data->show_issued)) {
        $data->show_issued = TRUE;
      }
      if (!isset($data->show_names)) {
        $data->show_names = FALSE;
      }
      if (!isset($data->ad_image)) {
        $data->ad_image = "";
      }
      if (!isset($data->ad_video)) {
        $data->ad_video = "";
      }
      if (!isset($data->ad_type) || $data->ad_type == "") {
        $data->ad_type = "carousel";
      }
      if (!isset($data->turn_on_tv)) {
        $data->turn_on_tv = FALSE;
      }
      if (!isset($data->tv_channel)) {
        $data->tv_channel = "";
      }
      if (!isset($data->ticker_message)) {
        $data->ticker_message = "";
      }
      if (!isset($data->ticker_message2)) {
        $data->ticker_message2 = "";
      }
      if (!isset($data->ticker_message3)) {
        $data->ticker_message3 = "";
      }
      if (!isset($data->ticker_message4)) {
        $data->ticker_message4 = "";
      }
      if (!isset($data->ticker_message5)) {
        $data->ticker_message5 = "";
      }
      if (!isset($data->adspace_size)) {
        $data->adspace_size = "517px";
      }
      if (!isset($data->numspace_size)) {
        $data->numspace_size = "517px";
      }
      $data->adspace_size = "517px";
      $data->numspace_size = "517px";
      $data->ad_type = "carousel";

      //$data->display = "1-6";
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . $business_id . '.json', $encode);
    }
    echo 'JSON files are now fixed.';
  }

}




// Update Contact Form with Custom Fields if applicable
/*
$custom_fields = '';
$forms = new FormsController();
$fields = $forms->getFields($business_id);
foreach ($fields as $form_id => $field_data) {
  if ($field_data['field_type'] == 'Text Field') {
    $custom_fields .= '<div class="col-md-3"><label>'. $field_data['label'] . '</label></div>
      <div class="col-md-9"><input type="text" class="form-control custom-field" id="forms_' . $form_id . '" /></div>';
  }
  elseif ($field_data['field_type'] == 'Radio') {
    $custom_fields .= '<div class="col-md-3"><label>'. $field_data['label'] . '</label></div>
      <div class="col-md-9"><label class="radio-inline"><input type="radio" name="forms_' . $form_id . '" value="' . $field_data['value_a'] . '" >' . $field_data['value_a'] . '</label><label class="radio-inline"><input type="radio" name="forms_' . $form_id . '" value="' . $field_data['value_b'] . '">' . $field_data['value_b'] . '</label></div>';
  }
  elseif ($field_data['field_type'] == 'Checkbox') {
    $custom_fields .= '<div class="col-md-offset-3 col-md-9 mb10 mt10"><label class="checkbox-inline"><input type="checkbox" id="forms_' . $form_id . '" value="1"/>' . $field_data['label'] . '</label></div>';
  }
  elseif ($field_data['field_type'] == 'Dropdown') {
    $select_options = '';
    $select_options .= '<option value="0">- Select -</option>';
    foreach($field_data['options'] as $count => $val) {
      $select_options .= '<option value="' . $val . '">' . $val . '</option>';
    }
    $custom_fields .= '<div class="col-md-3"><label>'. $field_data['label'] . '</label></div>
      <div class="col-md-9"><select class="form-control custom-dropdown" id="forms_' . $form_id . '"/>' . $select_options . '</select></div>';
  }
}

$ticker_message = array();
if (isset($data->ticker_message)) {
    if ($data->ticker_message != ''){
        array_push($ticker_message, $data->ticker_message);
    }
}
if (isset($data->ticker_message2)) {
    if ($data->ticker_message2 != '') {
        array_push($ticker_message, $data->ticker_message2);
    }
}
if (isset($data->ticker_message3)){
    if ($data->ticker_message3 != ''){
        array_push($ticker_message, $data->ticker_message3);
    }
}
if (isset($data->ticker_message4)){
    if ($data->ticker_message4 != ''){
        array_push($ticker_message, $data->ticker_message4);
    }
}
if (isset($data->ticker_message5)){
    if ($data->ticker_message5 != ''){
        array_push($ticker_message, $data->ticker_message5);
    }
}
*/

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
