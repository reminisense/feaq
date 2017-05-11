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
class BroadcastController extends BaseController {

  // The redirection code if ever the user visits the generic url
  public function getBusiness($business_id = 0) {
    return Redirect::to('/' . Business::getRawCodeByBusinessId($business_id));
  }

  // The broadcast rendering function
  public function viewBroadcastPage($raw_code = '') {
    if (Business::businessWithVanityURLExists($raw_code)) {
      $business_id = Business::getBusinessIdByVanityURL($raw_code);
      $custom_url = $raw_code;
    }
    else {
      try {
        $business_id = Business::getBusinessIdByRawCode($raw_code);
        $vanity_url = Business::getVanityURLByRawCode($raw_code);
        if ($vanity_url && trim($vanity_url) != '') {
          return Redirect::to('/' . $vanity_url);
        }
        $custom_url = $raw_code;
      } catch (Exception $e) {
        return Redirect::to('/');
      }
    }
    $data = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'));
    $ad_src = $this->fetchAdSource($data->ad_type, $business_id, $data->tv_channel);
    $business_name = Business::name($business_id);
    $open_time = str_pad(Business::openHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::openMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::openAMPM($business_id);
    $close_time = str_pad(Business::closeHour($business_id), 2, 0, STR_PAD_LEFT) . ':' . str_pad(Business::closeMinute($business_id), 2, 0, STR_PAD_LEFT) . ' ' . Business::closeAMPM($business_id);
    $first_service = Service::getFirstServiceOfBusiness($business_id);
    $allow_remote = $first_service ? QueueSettings::allowRemote($first_service->service_id) : 0;
    $ticker_message = $this->tickerPusher($data->ticker_message, $data->ticker_message2, $data->ticker_message3, $data->ticker_message4, $data->ticker_message5);
    $templates = $this->broadcastTemplate($data->display, $business_id);
    $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $regions = $this->broadcastRegionsClassName($data->adspace_size, $data->numspace_size);
    $ad_class = $regions['ad_class'];
    $num_class = $regions['num_class'];
    $numboxes = $this->numBoxesClassName($data->display, $regions['percentage']);
    $row_class = $numboxes['row_class'];
    $box_class = $numboxes['box_class'];
    $service_filters = Service::getServicesByBusinessId($business_id);
    $terminal_filters = array();
    foreach ($service_filters as $count => $service_filter) {
      $terminal_entries = Terminal::getTerminalsByServiceId($service_filter->service_id);
      foreach ($terminal_entries as $count => $terminal_entry) {
        $terminal_filters[$service_filter->service_id][] = array(
          'terminal_id' => $terminal_entry["terminal_id"],
          'terminal_name' => $terminal_entry["name"],
        );
      }
    }
    return View::make($templates['broadcast_template'])
      //->with('custom_fields', $custom_fields)
      //->with('template_type', $data->d)
      ->with('first_service', Service::getFirstServiceOfBusiness($business_id))
      ->with('allow_remote', $allow_remote)
      ->with('ticker_width', 100 - $regions['percentage'])
      ->with('custom_url', $custom_url)
      ->with('adspace_size', $data->adspace_size)
      ->with('carousel_delay', isset($data->carousel_delay) ? (int) $data->carousel_delay : 5000)
      ->with('ad_type', $data->ad_type)
      ->with('ad_src', $ad_src)
      ->with('box_num', explode("-", $data->display)[1])// the second index tells how many numbers to show in the broadcast screen
      ->with('broadcast_type', $templates['broadcast_type'])
      ->with('open_time', $open_time)
      ->with('close_time', $close_time)
      ->with('local_address', Business::localAddress($business_id))
      ->with('business_id', $business_id)/* RDH Changed error, 'branch_id' to 'business_id' */
      ->with('business_name', $business_name)
      ->with('lines_in_queue', Analytics::getBusinessRemainingCount($business_id))
      ->with('estimate_serving_time', Analytics::getAverageTimeServedByBusinessId($business_id, 'string', $date, $date))
      ->with('ticker_message', $ticker_message)
      ->with('ad_class', $ad_class)
      ->with('num_class', $num_class)
      ->with('row_class', $row_class)
      ->with('box_class', $box_class)
      ->with('user', Auth::user())
      ->with('service_filters', $service_filters)
      ->with('terminal_filters', $terminal_filters)
      ->with('show_qr_setting', $data->show_qr_setting)
      ->with('percentage', $regions['percentage'])
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
    else {
      if ($percentage == 10) {
        $ad_class = 'ninety';
        $num_class = 'ten';
      }
      else {
        if ($percentage == 20) {
          $ad_class = 'eighty';
          $num_class = 'twenty';
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
      }
    }
    return array(
      'ad_class' => $ad_class,
      'num_class' => $num_class,
      'percentage' => $percentage
    );
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
    return array(
      'broadcast_template' => $broadcast_template,
      'broadcast_type' => $broadcast_type
    );
  }

  public function getNumbers($branch_id = 0) {
    return file_get_contents(public_path() . '/json/' . $branch_id . '.json');
  }

  public function getServicesCurrentNumber($branch_id) {
    $services = PriorityNumber::getBranchServicesActiveQueue($branch_id);
    foreach ($services as $key => $service) {
      $services[$key] = $this->getServiceKeyDetails($service, $branch_id);
    }
    return $services;
  }

  public function getServiceKeyDetails($service, $branch_id) {
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
      $data->show_issued = Input::get('show_issued');
      $data->show_names = Input::get('show_names');
      $data->ticker_message = Input::get('ticker_message');
      $data->ticker_message2 = Input::get('ticker_message2');
      $data->ticker_message3 = Input::get('ticker_message3');
      $data->ticker_message4 = Input::get('ticker_message4');
      $data->ticker_message5 = Input::get('ticker_message5');
      $data->show_qr_setting = Input::get('show_qr_setting');
      $count = 0;
      if (Input::get('box1_service')) {
        $count++;
      }
      if (Input::get('box2_service')) {
        $count++;
      }
      if (Input::get('box3_service')) {
        $count++;
      }
      if (Input::get('box4_service')) {
        $count++;
      }
      if (Input::get('box5_service')) {
        $count++;
      }
      if (Input::get('box6_service')) {
        $count++;
      }
      if (Input::get('box7_service')) {
        $count++;
      }
      if (Input::get('box8_service')) {
        $count++;
      }
      if (Input::get('box9_service')) {
        $count++;
      }
      if (Input::get('box10_service')) {
        $count++;
      }
      if (Input::get('box11_service')) {
        $count++;
      }
      if (Input::get('box12_service')) {
        $count++;
      }
      if (Input::get('box13_service')) {
        $count++;
      }
      if (Input::get('box14_service')) {
        $count++;
      }
      if (Input::get('box15_service')) {
        $count++;
      }
      if (Input::get('box16_service')) {
        $count++;
      }
      $data->display = $this->generateDisplayCode($data->ad_type, $count);
      $data = $this->boxObjectCreator($data, Input::get('num_boxes'));
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . Input::get('business_id') . '.json', $encode);
      $service_name1 = Input::get('box1_service') ? Service::name(Input::get('box1_service')) : '';
      $service_name2 = Input::get('box2_service') ? Service::name(Input::get('box2_service')) : '';
      $service_name3 = Input::get('box3_service') ? Service::name(Input::get('box3_service')) : '';
      $service_name4 = Input::get('box4_service') ? Service::name(Input::get('box4_service')) : '';
      $service_name5 = Input::get('box5_service') ? Service::name(Input::get('box5_service')) : '';
      $service_name6 = Input::get('box6_service') ? Service::name(Input::get('box6_service')) : '';
      $service_name7 = Input::get('box7_service') ? Service::name(Input::get('box7_service')) : '';
      $service_name8 = Input::get('box8_service') ? Service::name(Input::get('box8_service')) : '';
      $service_name9 = Input::get('box9_service') ? Service::name(Input::get('box9_service')) : '';
      $service_name10 = Input::get('box10_service') ? Service::name(Input::get('box10_service')) : '';
      $service_name11 = Input::get('box11_service') ? Service::name(Input::get('box11_service')) : '';
      $service_name12 = Input::get('box12_service') ? Service::name(Input::get('box12_service')) : '';
      $service_name13 = Input::get('box13_service') ? Service::name(Input::get('box13_service')) : '';
      $service_name14 = Input::get('box14_service') ? Service::name(Input::get('box14_service')) : '';
      $service_name15 = Input::get('box15_service') ? Service::name(Input::get('box15_service')) : '';
      $service_name16 = Input::get('box16_service') ? Service::name(Input::get('box16_service')) : '';
      if ($service_name1) {
        $service_boxes['box1'] = array(
          'service_id' => Input::get('box1_service'),
          'service_name' => $service_name1,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name2) {
        $service_boxes['box2'] = array(
          'service_id' => Input::get('box2_service'),
          'service_name' => $service_name2,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name3) {
        $service_boxes['box3'] = array(
          'service_id' => Input::get('box3_service'),
          'service_name' => $service_name3,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name4) {
        $service_boxes['box4'] = array(
          'service_id' => Input::get('box4_service'),
          'service_name' => $service_name4,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name5) {
        $service_boxes['box5'] = array(
          'service_id' => Input::get('box5_service'),
          'service_name' => $service_name5,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name6) {
        $service_boxes['box6'] = array(
          'service_id' => Input::get('box6_service'),
          'service_name' => $service_name6,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name7) {
        $service_boxes['box7'] = array(
          'service_id' => Input::get('box7_service'),
          'service_name' => $service_name7,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name8) {
        $service_boxes['box8'] = array(
          'service_id' => Input::get('box8_service'),
          'service_name' => $service_name8,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name9) {
        $service_boxes['box9'] = array(
          'service_id' => Input::get('box9_service'),
          'service_name' => $service_name9,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name10) {
        $service_boxes['box10'] = array(
          'service_id' => Input::get('box10_service'),
          'service_name' => $service_name10,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name11) {
        $service_boxes['box11'] = array(
          'service_id' => Input::get('box11_service'),
          'service_name' => $service_name11,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name12) {
        $service_boxes['box12'] = array(
          'service_id' => Input::get('box12_service'),
          'service_name' => $service_name12,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name13) {
        $service_boxes['box13'] = array(
          'service_id' => Input::get('box13_service'),
          'service_name' => $service_name13,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name14) {
        $service_boxes['box14'] = array(
          'service_id' => Input::get('box14_service'),
          'service_name' => $service_name14,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name15) {
        $service_boxes['box15'] = array(
          'service_id' => Input::get('box15_service'),
          'service_name' => $service_name15,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      if ($service_name16) {
        $service_boxes['box16'] = array(
          'service_id' => Input::get('box16_service'),
          'service_name' => $service_name16,
          'current_number' => '',
          'terminal' => '',
          'color' => '',
          'called_numbers' => '',
        );
      }
      $service_boxes['now_num'] = '';
      $service_boxes['now_service'] = '';
      $service_boxes['now_terminal'] = '';
      $service_boxes['now_color'] = '';
      $service_boxes['display'] = $data->display;
      ServiceBoxes::updateBoxes(1, Input::get('box1_service'), $service_name1);
      ServiceBoxes::updateBoxes(2, Input::get('box2_service'), $service_name2);
      ServiceBoxes::updateBoxes(3, Input::get('box3_service'), $service_name3);
      ServiceBoxes::updateBoxes(4, Input::get('box4_service'), $service_name4);
      ServiceBoxes::updateBoxes(5, Input::get('box5_service'), $service_name5);
      ServiceBoxes::updateBoxes(6, Input::get('box6_service'), $service_name6);
      ServiceBoxes::updateBoxes(7, Input::get('box7_service'), $service_name7);
      ServiceBoxes::updateBoxes(8, Input::get('box8_service'), $service_name8);
      ServiceBoxes::updateBoxes(9, Input::get('box9_service'), $service_name9);
      ServiceBoxes::updateBoxes(10, Input::get('box10_service'), $service_name10);
      ServiceBoxes::updateBoxes(11, Input::get('box11_service'), $service_name11);
      ServiceBoxes::updateBoxes(12, Input::get('box12_service'), $service_name12);
      ServiceBoxes::updateBoxes(13, Input::get('box13_service'), $service_name13);
      ServiceBoxes::updateBoxes(14, Input::get('box14_service'), $service_name14);
      ServiceBoxes::updateBoxes(15, Input::get('box15_service'), $service_name15);
      ServiceBoxes::updateBoxes(16, Input::get('box16_service'), $service_name16);
      $file_path = public_path() . '/json/numbers.json';
      File::put($file_path, json_encode($service_boxes, JSON_PRETTY_PRINT));
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
    elseif ($ad_type == 'internet_tv' || $ad_type == 'local_video') {
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
    if ($num_boxes >= '10') {
      $data->box10 = new stdClass();
      $data->box10->number = '';
      $data->box10->terminal = '';
      $data->box10->rank = '';
      $data->box10->service = '';
      $data->box10->color = '';
    }
    if ($num_boxes >= '11') {
      $data->box11 = new stdClass();
      $data->box11->number = '';
      $data->box11->terminal = '';
      $data->box11->rank = '';
      $data->box11->service = '';
      $data->box11->color = '';
    }
    if ($num_boxes >= '12') {
      $data->box12 = new stdClass();
      $data->box12->number = '';
      $data->box12->terminal = '';
      $data->box12->rank = '';
      $data->box12->service = '';
      $data->box12->color = '';
    }
    if ($num_boxes >= '13') {
      $data->box13 = new stdClass();
      $data->box13->number = '';
      $data->box13->terminal = '';
      $data->box13->rank = '';
      $data->box13->service = '';
      $data->box13->color = '';
    }
    if ($num_boxes >= '14') {
      $data->box14 = new stdClass();
      $data->box14->number = '';
      $data->box14->terminal = '';
      $data->box14->rank = '';
      $data->box14->service = '';
      $data->box14->color = '';
    }
    if ($num_boxes >= '15') {
      $data->box15 = new stdClass();
      $data->box15->number = '';
      $data->box15->terminal = '';
      $data->box15->rank = '';
      $data->box15->service = '';
      $data->box15->color = '';
    }
    if ($num_boxes >= '16') {
      $data->box16 = new stdClass();
      $data->box16->number = '';
      $data->box16->terminal = '';
      $data->box16->rank = '';
      $data->box16->service = '';
      $data->box16->color = '';
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
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
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
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '3') {
      unset($data->box4);
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '4') {
      unset($data->box5);
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '5') {
      unset($data->box6);
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '6') {
      unset($data->box7);
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '7') {
      unset($data->box8);
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '8') {
      unset($data->box9);
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '9') {
      unset($data->box10);
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '10') {
      unset($data->box11);
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '11') {
      unset($data->box12);
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '12') {
      unset($data->box13);
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '13') {
      unset($data->box14);
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '14') {
      unset($data->box15);
      unset($data->box16);
    }
    elseif ($num_boxes == '15') {
      unset($data->box16);
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

  public function getServiceBoxes() {
    $service_boxes = array();
    $boxes = ServiceBoxes::fetchBoxes();
    foreach ($boxes as $box) {
      $service_boxes['box' . $box->box_num] = $box->service_id;
    }
    return json_encode($service_boxes);
  }

  /*
  public function postSetTheme() {
    $post = json_decode(file_get_contents("php://input"));
    if (Helper::isBusinessOwner($post->business_id, Helper::userId())) { // PAG added permission checking
      $data = json_decode(file_get_contents(public_path() . '/json/' . $post->business_id . '.json'));
      $data->show_issued = $post->show_issued;
      $data->display = $post->theme_type;
      if (strstr($post->theme_type, '-1')) {
        unset($data->\);
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
//      if (!isset($data->show_issued)) {
//        $data->show_issued = TRUE;
//      }
//      if (!isset($data->show_names)) {
//        $data->show_names = FALSE;
//      }
//      if (!isset($data->ad_image)) {
//        $data->ad_image = "";
//      }
//      if (!isset($data->ad_video)) {
//        $data->ad_video = "";
//      }
//      if (!isset($data->ad_type) || $data->ad_type == "") {
//        $data->ad_type = "carousel";
//      }
//      if (!isset($data->turn_on_tv)) {
//        $data->turn_on_tv = FALSE;
//      }
//      if (!isset($data->tv_channel)) {
//        $data->tv_channel = "";
//      }
//      if (!isset($data->ticker_message)) {
//        $data->ticker_message = "";
//      }
//      if (!isset($data->ticker_message2)) {
//        $data->ticker_message2 = "";
//      }
//      if (!isset($data->ticker_message3)) {
//        $data->ticker_message3 = "";
//      }
//      if (!isset($data->ticker_message4)) {
//        $data->ticker_message4 = "";
//      }
//      if (!isset($data->ticker_message5)) {
//        $data->ticker_message5 = "";
//      }
//      if (!isset($data->adspace_size)) {
//        $data->adspace_size = "517px";
//      }
//      if (!isset($data->numspace_size)) {
//        $data->numspace_size = "517px";
//      }
//      $data->adspace_size = "517px";
//      $data->numspace_size = "517px";
//      $data->ad_type = "carousel";
      $data->show_qr_setting = "yes";

      //$data->display = "1-6";
      $encode = json_encode($data);
      file_put_contents(public_path() . '/json/' . $business_id . '.json', $encode);
    }
    echo 'JSON files are now fixed.';
  }

  public function getResetBusinessColors($business_id) {
    $colors = array(
      '',
      'blue',
      'borange',
      'violet',
      'green',
      'red',
      'yellow',
      'cyan',
      'x242436',
      'x78250A',
      'FF745F',
      'FCA78B',
      'x53777A',
      'x542437',
      'C02942',
      'D95B43',
      'ECD078'
    );
    $services = Service::getServicesByBusinessId($business_id);
    $arrSize = count($colors);
    foreach ($services as $count => $service) {
      $serviceCount = $count + 1;
      if ($serviceCount > $arrSize) {
        $serviceCount = $serviceCount % $arrSize;
      }
      $terminals = Terminal::getTerminalsByServiceId($service->service_id);
      foreach ($terminals as $count2 => $terminal) {
        Terminal::setColor($colors[$serviceCount], $terminal['terminal_id']);
      }
    }
    echo 'colors reset';
  }

  public function getJsonRecreate() {
    $res = Business::all();
    foreach ($res as $count => $business) {
      $business_id = $business->business_id;
      $this->getJsonCreate($business_id);
    }
    echo 'JSON files deleted and recreated.';
  }

  public function getJsonCreate($business_id) {
    $file = public_path() . '/json/' . $business_id . '.json';
    if (file_exists($file)) {
      unlink($file);
    }
    $data = new stdClass();
    for ($boxnum = 1; $boxnum <= 6; $boxnum++) {
      $box = new stdClass();
      $box->number = '';
      $box->terminal = '';
      $box->rank = '';
      $box->service = '';
      $data->{"box" . $boxnum} = $box;
    }
    for ($boxnum = 5; $boxnum > 1; $boxnum--) {
      $data->{"ticker_message" . $boxnum} = '';
    }
    $data->ticker_message = '';
    $data->show_issued = TRUE;
    $data->show_names = FALSE;
    $data->ad_image = "";
    $data->ad_video = "";
    $data->ad_type = "carousel";
    $data->turn_on_tv = FALSE;
    $data->tv_channel = "";
    $data->adspace_size = "517px";
    $data->numspace_size = "517px";
    $data->display = "1-6";
    $data->get_num = " ";
    $data->carousel_delay = "5000";
    $data->date = date("mdy");
    $data->num_boxes = "6";
    $data->adspace_size = "517px";
    $data->numspace_size = "517px";
    $data->ad_type = "carousel";
    $encode = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file, $encode);
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
