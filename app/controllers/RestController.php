<?php
/**
 * Created by IntelliJ IDEA.
 * User: RUFFY
 * Date: 2/25/2015
 * Time: 10:29 AM
 */

class RestController extends BaseController {

    /**
     * @author Ruffy
     * @param null $quantity when User wants to specify how many to return
     * @return JSON response containing Business objects with: business_id, name, local_address
     */
    public function getPopularBusiness($quantity = null) {
        $businesses = DB::table('business')
            ->select(array('business_id', 'name', 'local_address'))
            ->take($quantity == null ? 5 : $quantity)
            ->get();

        $popular_business = array('popular-business' => $businesses);

        return Response::json($popular_business, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @param $query Query string input for searching for a business
     * @return JSON response containing businesses that qualified with the search query
     */
    public function getSearchBusiness($query) {
        $search_results = DB::table('business')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->select(array('business_id', 'name', 'local_address', 'latitude', 'longitude'))
            ->get();

        $found_business = array('search-result' => $search_results);
        return Response::json($found_business, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @param $id BusinessI ID of the selected business
     * @return JSON object generated through businessId according to the database
     */
    public function getBusinessDetail($id) {
        $search = Business::find($id);
        return Response::json($search, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @return JSON response containing list of active businesses
     */
    public function getActiveBusiness() {
        $active_businesses = array();
        $businesses = Business::all();
        foreach ($businesses as $count => $business) {
            $branches = Branch::getBranchesByBusinessId($business->business_id);
            foreach ($branches as $count2 => $branch) {
                $services = Service::getServicesByBranchId($branch->branch_id);
                foreach ($services as $count3 => $service) {
                    $priority_numbers = PriorityNumber::getTrackIdByServiceId($service->service_id);
                    foreach ($priority_numbers as $count4 => $priority_number) {
                        $priority_queues = PriorityQueue::getTransactionNumberByTrackId($priority_number->track_id);
                        foreach ($priority_queues as $count5 => $priority_queue) {
                            $terminal_transactions = TerminalTransaction::getTimesByTransactionNumber($priority_queue->transaction_number);
                            foreach ($terminal_transactions as $count6 => $terminal_transaction) {
                                $grace_period = time() - $terminal_transaction->time_queued; // issued time must be on the current day to count as active
                                if ($terminal_transaction->time_queued != 0
                                    && $terminal_transaction->time_completed == 0
                                    && $terminal_transaction->time_removed == 0
                                    && $grace_period < 86400 ) { // 1 day; 60secs * 60 min * 24 hours
                                    $active_businesses[] = array(
                                        'business_id' => $business->business_id,
                                        'local_address' => $business->local_address,
                                        'name' => $business->name,
                                    );
                                    $actives = array('active-business' => $active_businesses);
                                    break;
                                }
                            }
                            if (array_key_exists($business->business_id, $active_businesses)) {
                                break;
                            }
                        }
                        if (array_key_exists($business->business_id, $active_businesses)) {
                            break;
                        }
                    }
                    if (array_key_exists($business->business_id, $active_businesses)) {
                        break;
                    }
                }
                if (array_key_exists($business->business_id, $active_businesses)) {
                    break;
                }
            }
        }
        return Response::json($actives, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * @author Ruffy
     * @param int $business_id
     * @return Formatted single JSON Object that contains all attributes related to the Broadcast Page numbers
     */
    public function getShowNumber($business_id = 0) {
        $numbers = json_decode(file_get_contents(public_path() . '/json/' . $business_id . '.json'), true);
        $output = array();

        $get_num = $numbers['get_num'];
        $display = $numbers['display'];
        $date = $numbers['date'];

        unset($numbers['get_num']);
        unset($numbers['display']);
        unset($numbers['date']);
        unset($numbers['show_issued']);
        unset($numbers['turn_on_tv']);
        unset($numbers['ad_video']);
        unset($numbers['tv_channel']);
        unset($numbers['ad_type']);
        unset($numbers['ad_image']);

        foreach($numbers as $key => $box_data) {
            // generate object attribute
            $title = $key;
            foreach($box_data as $key2 => $box_details) {
                $title = $title . $key2;
                $output[$title] = $numbers[$key][$key2];
            }
        }
        $output['get_num'] = $get_num;
        $output['display'] = $display;
        $output['date'] = $date;

        return Response::json($output, 200, array(), JSON_PRETTY_PRINT);
    }

    public function getRegisterUser()
    {
        $params = func_get_args();

        $data = array(
            'fb_id' => $params[0],
            'fb_url' => 'https://www.facebook.com/app_scoped_user_id/' . $params[0] . '/', // https://www.facebook.com/app_scoped_user_id/1438888283100110/
            'first_name' => $params[1],
            'last_name' => $params[2],
            'email' => $params[3],
            'gender' => $params[4],
            'phone' => $params[5],
            'country' => $params[6],
        );
        User::saveFBDetails($data);
//        Auth::loginUsingId(User::getUserIdByFbId($data['fb_id']));
        return json_encode(array('success' => $data['fb_id']));
    }

    /**
     * @author Aunne
     * @param $facebook_id
     * @param int $limit
     * @return JSON containing the industries view/searched by user
     */
    public function getUserIndustryInfo($facebook_id, $limit = 10){
        try{
            $user_id = User::getUserIdByFbId($facebook_id);
        }catch(Exception $e){
            $user_id = null;
        }

        if($user_id){
            $industry_data = Watchdog::queryUserInfo('industry', $user_id);
            unset($industry_data['Industry']); //remove industry index since this is useless data caused by searching without industry parameter
            arsort($industry_data);
            $industry_data = array_slice($industry_data, 0, $limit);
            return json_encode(['industries' => $industry_data]);
        }else{
            return json_encode(['error' => 'You are not registered to FeatherQ.']);
        }

    }

    /**
     * @author Aunne Rouie Arzadon
     * @param $facebook_id
     * @return string
     */
    public function getQueueInfo($facebook_id){
        try{
            $user_id = User::getUserIdByFbId($facebook_id);
        }catch(Exception $e){
            $user_id = null;
        }

        if($user_id){
            $transaction_number = PriorityQueue::getLatestTransactionNumberOfUser($user_id);
            $priority_number = PriorityQueue::priorityNumber($transaction_number);
            $track_id = PriorityQueue::trackId($transaction_number);
            $service_id = PriorityNumber::serviceId($track_id);
            $business_id = Branch::businessId(Service::branchId($service_id));

            $details = [
                'number_assigned' => $priority_number,
                'business_id' => $business_id,
                'business_name' => Business::name($business_id),
                'current_number_called' => ProcessQueue::currentNumber($service_id),
                'estimated_time_until_called' => Analytics::getWaitingTime($business_id),
                'status' => TerminalTransaction::queueStatus($transaction_number),
            ];

            return json_encode($details);
        }else{
            return json_encode(['error' => 'You are not registered to FeatherQ.']);
        }

    }

    /**
     * @author Ruffy
     * @param $query Query string input for searching for a businesses under an industry
     * @return JSON response containing businesses that qualified with the search query
     */
    public function getSearchIndustry($query) {
        $search_results = DB::table('business')
            ->where('industry', '=', $query)
            ->select(array('business_id', 'name', 'local_address', 'latitude', 'longitude'))
            ->get();

        $found_business = array('search-result' => $search_results);
        return Response::json($found_business, 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Queue To Business
     * @param $facebook_id
     * @param $business_id
     * @return string
     */
    /*
    public function getQueueBusiness($facebook_id, $business_id){
        try{
            $user_id = User::getUserIdByFbId($facebook_id);
        }catch(Exception $e){
            $user_id = null;
        }

        if($user_id){
            $service = Service::getFirstServiceOfBusiness($business_id);
            $service_id = $service->service_id;

            $name = User::full_name($user_id);
            $phone = User::phone($user_id);
            $email = User::email($user_id);

            $next_number = ProcessQueue::nextNumber(ProcessQueue::lastNumberGiven($service_id), QueueSettings::numberStart($service_id), QueueSettings::numberLimit($service_id));
            $priority_number = $next_number;
            $queue_platform = 'Android';

            $number = ProcessQueue::issueNumber($service_id, $priority_number, null, $queue_platform);
            PriorityQueue::updatePriorityQueueUser($number['transaction_number'], $name, $phone, $email);

            $details = [
                'number_assigned' => $priority_number,
                'business_id' => $business_id,
                'business_name' => Business::name($business_id),
                'current_number_called' => ProcessQueue::currentNumber($service_id),
                'estimated_time_until_called' => Analytics::getWaitingTime($business_id),
            ];

            return json_encode($details);
        }else{
            return json_encode(['error' => 'You are not registered to FeatherQ.']);
        }

    }
    */

}