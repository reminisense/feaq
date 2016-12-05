<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/10/15
 * Time: 4:51 PM
 */

class Analytics extends Eloquent{
    protected $table = 'queue_analytics';
    public $timestamps = false;

    public static function getBusinessRemainingCount($business_id){
        $uncalled_numbers = 0;
        $branches = Branch::getBranchesByBusinessId($business_id);
        foreach($branches as $branch){
            $uncalled_numbers += Analytics::getBranchRemainingCount($branch->branch_id);
        }
        return $uncalled_numbers;
    }

    public static function getBranchRemainingCount($branch_id){
        $uncalled_numbers = 0;
        $services = Service::getServicesByBranchId($branch_id);
        foreach($services as $service){
            $uncalled_numbers += Analytics::getServiceRemainingCount($service->service_id);
        }
        return $uncalled_numbers;
    }

    public static function getServiceRemainingCount($service_id){
        $all_numbers = ProcessQueue::allNumbers($service_id);
        return isset($all_numbers->uncalled_numbers) ? count($all_numbers->uncalled_numbers) : 0;
    }

    /**
     * Saving To Queue Analytics table
     */

    public static function saveQueueAnalytics($values){
        DB::table('queue_analytics')->insert($values);
    }

    public static function insertAnalyticsQueueNumber($action, $transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform){
        $values = [
            'transaction_number' => $transaction_number,
            'date' => $date,
            'business_id' => Business::getBusinessIdByServiceId($service_id),
            'branch_id' => Service::branchId($service_id),
            'service_id' => $service_id,
            'terminal_id' => $terminal_id,
            'queue_platform' => $queue_platform,
            // FIXME we must not use helper methods in the context of the model to ensure that our app is decoupled.
            'user_id' => Helper::userId(),
            'action' => $action,
            'action_time' => $time
        ];

        Analytics::saveQueueAnalytics($values);
    }

    public static function insertAnalyticsQueueNumberIssued($transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform){
        Analytics::insertAnalyticsQueueNumber(0, $transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform);
    }

    public static function insertAnalyticsQueueNumberCalled($transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform){
        Analytics::insertAnalyticsQueueNumber(1, $transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform);
    }

    public static function insertAnalyticsQueueNumberServed($transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform){
        Analytics::insertAnalyticsQueueNumber(2, $transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform);
    }

    public static function insertAnalyticsQueueNumberRemoved($transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform){
        Analytics::insertAnalyticsQueueNumber(3, $transaction_number, $service_id, $date, $time, $terminal_id, $queue_platform);
    }

    /**
     * requires an array of arrays
     * ex. 'field' => array('conditional_operator', 'value')
     * @param $conditions
     * @return mixed
     */
    public static function getQueueAnalyticsRows($conditions){
        return Helper::getMultipleQueries('queue_analytics', $conditions);
    }

    public static function getBusinessAnalytics($business_id, $startdate = null, $enddate = null){
        Log::info('Getting Business Analytics.');
        $business = Business::where('business_id', '=', $business_id)->first();
        $business_features = unserialize($business->business_features);
        $business_package = $business_features['package_type']; // basic, plus, pro
        switch ($business_package){
            case 'Pro':
                Log::info('Obtaining business analytics for pro package.');
                $data = Analytics::getProAnalytics($business_id, $startdate, $enddate);
                break;
            case 'Plus':
                Log::info('Obtaining business analytics for plus package.');
                $data = Analytics::getPlusAnalytics($business_id, $startdate, $enddate);
                break;
            default:
                Log::info('Obtaining business analytics for basic package.');
                $data = Analytics::getBasicAnalytics($business_id, $startdate, $enddate);
                break;
        }

        return $data;
    }

    public static function getBasicAnalytics($business_id, $startdate = null, $enddate = null){
        $startdate = $startdate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $startdate;
        $enddate = $enddate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $enddate;

        $analytics = [
            'remaining_count' => Analytics::getBusinessRemainingCount($business_id),
            'total_numbers_issued' => Analytics::getTotalNumbersIssuedByBusinessId($business_id, $startdate, $enddate),
            'total_numbers_called' => Analytics::getTotalNumbersCalledByBusinessId($business_id, $startdate, $enddate),
            'total_numbers_served' => Analytics::getTotalNumbersServedByBusinessId($business_id, $startdate, $enddate),
            'total_numbers_dropped' => Analytics::getTotalNumbersDroppedByBusinessId($business_id, $startdate, $enddate),
            'average_time_called' => Analytics::getAverageTimeCalledByBusinessId($business_id, 'string', $startdate, $enddate),
            'average_time_served' => Analytics::getAverageTimeServedByBusinessId($business_id, 'string', $startdate, $enddate)
        ];

        return $analytics;
    }

    public static function getPlusAnalytics($business_id, $startdate = null, $enddate = null){
        $startdate = $startdate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $startdate;
        $enddate = $enddate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $enddate;

        $terminals = [];
        $business_terminals = Terminal::getTerminalsByBusinessId($business_id);
        foreach($business_terminals as $terminal_index => $terminal){
            $terminal_users = TerminalUser::getAssignedUsers($terminal['terminal_id']);
            $terminals[$terminal_index] = [
                'terminal_id' =>  $terminal['terminal_id'],
                'terminal_name' => $terminal['name'],
                'users' => [],
            ];
            foreach($terminal_users as $user_index => $user){
                $terminals[$terminal_index]['users'][] = [
                    'user_id' => $user['user_id'],
                    'user_name' => $user['first_name'] . ' ' . $user['last_name'],
                    //'numbers_issued' => Analytics::getTotalNumbersIssuedByTerminalUser($user['user_id'], $terminal['terminal_id'], $startdate, $enddate),
                    'numbers_called' => Analytics::getTotalNumbersCalledByTerminalUser($user['user_id'], $terminal['terminal_id'], $startdate, $enddate),
                    'numbers_served' => Analytics::getTotalNumbersServedByTerminalUser($user['user_id'], $terminal['terminal_id'], $startdate, $enddate),
                    'numbers_dropped' => Analytics::getTotalNumbersDroppedByTerminalUser($user['user_id'], $terminal['terminal_id'], $startdate, $enddate),
                    'average_serving_time' => Analytics::getAverageTimeServedByTerminalUser($user['user_id'], $terminal['terminal_id'], 'string', $startdate, $enddate),
                ];
            }
        }

        //getting the queue activity for the start date of
        $queue_activity = [];
        for($starttime = $startdate; $starttime < strtotime('+1 day', $startdate); $starttime = strtotime('+1 hour', $starttime)){
            $queue_activity[] = [
                'time' => date('Y-m-d H:00', $starttime),
                'value' => count(Analytics::getQueueAnalyticsRows(['action' => ['=', 0], 'business_id' => ['=', $business_id ], 'action_time' => ['>=', $starttime], 'action_time.' => ['<=', strtotime('+1 hour', $starttime)]])),
            ];
        }

        $data = [
            'terminals' => $terminals,
            'queue_activity' => $queue_activity,
        ];

        $basic = Analytics::getBasicAnalytics($business_id, $startdate, $enddate);
        $data = array_merge($data, $basic);
        return $data;
    }

    public static function getProAnalytics($business_id, $startdate = null, $enddate = null){
        $startdate = $startdate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $startdate;
        $enddate = $enddate == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $enddate;

        $data = [
            'staff_reports' => [],
        ];

        $plus = Analytics::getPlusAnalytics($business_id, $startdate, $enddate);
        $data = array_merge($data, $plus);
        return $data;
    }


    /**
     * individual queries
     */

    public static function getTotalNumbersIssuedByTerminalUser($user_id, $terminal_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 0], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id],  'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersCalledByTerminalUser($user_id, $terminal_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 1], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersServedByTerminalUser($user_id, $terminal_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 2], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersDroppedByTerminalUser($user_id, $terminal_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 3], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersIssuedByBusinessId($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 0], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersCalledByBusinessId($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 1], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersServedByBusinessId($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 2], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersDroppedByBusinessId($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 3], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersProcessedByBusinessId($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['>', 1], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]));
    }

    public static function getAverageTimeCalledByBusinessId($business_id, $format = 'string', $startdate, $enddate){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByBusinessId(0, 1, $business_id, $startdate, $enddate);
        }else{
            return Analytics::getAverageTimeValueFromActionByBusinessId(0, 1, $business_id, $startdate, $enddate);
        }
    }

    public static function getAverageTimeServedByBusinessId($business_id, $format = 'string', $startdate, $enddate){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByBusinessId(1, 2, $business_id, $startdate, $enddate);
        }else{
            return Analytics::getAverageTimeValueFromActionByBusinessId(1, 2, $business_id, $startdate, $enddate);
        }
    }

    public static function getAverageTimeCalledByServiceId($business_id, $format = 'string', $startdate, $enddate){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByServiceId(0, 1, $business_id, $startdate, $enddate);
        }else{
            return Analytics::getAverageTimeValueFromActionByServiceId(0, 1, $business_id, $startdate, $enddate);
        }
    }

    public static function getAverageTimeServedByTerminalUser($user_id, $terminal_id, $format = 'string', $startdate, $enddate){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByTerminalUser(1, 2, $user_id, $terminal_id, $startdate, $enddate);
        }else{
            return Analytics::getAverageTimeValueFromActionByTerminalUser(1, 2, $user_id, $terminal_id, $startdate, $enddate);
        }
    }

    //gets the string representation of the average time
    public static function getAverageTimeFromActionByBusinessId($action1, $action2, $business_id, $startdate, $enddate){
        return Helper::millisecondsToHMSFormat(Analytics::getAverageTimeValueFromActionByBusinessId($action1, $action2, $business_id, $startdate, $enddate));
    }

    public static function getAverageTimeFromActionByServiceId($action1, $action2, $service_id, $startdate, $enddate){
        return Helper::millisecondsToHMSFormat(Analytics::getAverageTimeValueFromActionByServiceId($action1, $action2, $service_id, $startdate, $enddate));
    }

    public static function getAverageTimeFromActionByTerminalUser($action1, $action2, $user_id, $terminal_id, $startdate, $enddate){
        return Helper::millisecondsToHMSFormat(Analytics::getAverageTimeValueFromActionByTerminalUser($action1, $action2, $user_id, $terminal_id, $startdate, $enddate));
    }

    //gets the numeric representation of the average time
    public static function getAverageTimeValueFromActionByBusinessId($action1, $action2, $business_id, $startdate, $enddate){
        $action1_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action1], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        $action2_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action2], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        return Analytics::getAverageTimeFromActionArray($action1_numbers, $action2_numbers);
    }

    public static function getAverageTimeValueFromActionByServiceId($action1, $action2, $service_id, $startdate, $enddate){
        $action1_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action1], 'service_id' => ['=', $service_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        $action2_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action2], 'service_id' => ['=', $service_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        return Analytics::getAverageTimeFromActionArray($action1_numbers, $action2_numbers);
    }

    public static function getAverageTimeValueFromActionByTerminalUser($action1, $action2, $user_id, $terminal_id, $startdate, $enddate){
        $action1_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action1], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        $action2_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action2], 'user_id' => ['=', $user_id ], 'terminal_id' => ['=', $terminal_id ], 'date' => ['>=', $startdate], 'date.' => ['<=', $enddate]]);
        return Analytics::getAverageTimeFromActionArray($action1_numbers, $action2_numbers);
    }

    public static function getAverageTimeFromActionArray($action1_numbers, $action2_numbers){
        $counter = 0;
        $time_sum = 0;
        foreach($action1_numbers as $action1_number){
            foreach($action2_numbers as $action2_number){
                if($action1_number->transaction_number == $action2_number->transaction_number){
                    $counter++;
                    $time_sum += ($action2_number->action_time - $action1_number->action_time);
                    break 1;
                }
            }
        }
        $average = $counter == 0 ? 0 : round($time_sum/$counter);
        return $average;
    }

    public static function getTotalNumbersCalledByBusinessIdWithDate($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 1], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date' => ['<=', $enddate]]));
    }

    /**
     * ARA Computes for the time the next available number has to wait in order to be called
     * equation : time_to_be_called = average_calling_time x numbers_remaining_in_queue
     */
    public static function getServiceWaitingTime($service_id){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $numbers_in_queue = Analytics::getServiceRemainingCount($service_id);
        $average_waiting_time = Analytics::getAverageTimeCalledByServiceId($service_id, 'numeric', $date, $date);
        return $average_waiting_time * $numbers_in_queue;
    }

    public static function getWaitingTime($business_id){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $numbers_in_queue = Analytics::getBusinessRemainingCount($business_id);
        $average_waiting_time = Analytics::getAverageTimeCalledByBusinessId($business_id, 'numeric', $date, $date);
        return $average_waiting_time * $numbers_in_queue;
    }

    public static function getWaitingTimeByTransactionNumber($transaction_number){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $service_id = PriorityNumber::serviceId(PriorityQueue::trackId($transaction_number));
        $numbers_ahead = Analytics::getNumbersAhead($transaction_number);
        $average_waiting_time = Analytics::getAverageTimeCalledByServiceId($service_id, 'numeric', $date, $date);
        return $average_waiting_time * $numbers_ahead * 1000; //convert to milliseconds
    }

    public static function getNumbersAhead($transaction_number){
        $date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $service_id = PriorityNumber::serviceId(PriorityQueue::trackId($transaction_number));
        $numbers_ahead = TerminalTransaction::join('priority_queue', 'priority_queue.transaction_number', '=', 'terminal_transaction.transaction_number')
            ->join('priority_number', 'priority_number.track_id', '=', 'priority_queue.track_id')
            ->where('priority_number.service_id', '=', $service_id)
            ->where('priority_number.date', '=', $date)
            ->where('terminal_transaction.transaction_number', '<', $transaction_number)
            ->where('terminal_transaction.time_queued', '>', 0)
            ->where('terminal_transaction.time_called', '=', 0)
            ->where('terminal_transaction.time_completed', '=', 0)
            ->where('terminal_transaction.time_removed', '=', 0)
            ->select('terminal_transaction.transaction_number')
            ->get();
        return count($numbers_ahead);
    }


    public static function getWaitingTimeString($business_id){
        $waiting_time = Analytics::getWaitingTime($business_id);
        $waiting_time = floor($waiting_time / 60);

        //Reduced to 3 different line statuses
        if($waiting_time > 30){
            $waiting_time_string = 'heavy';
        }else if($waiting_time <= 30 && $waiting_time > 15){
            $waiting_time_string = 'moderate';
        }else{
            $waiting_time_string = 'light';
        }

        return $waiting_time_string;
    }

    public static function getLastActive($business_id){
        $last = Analytics::orderBy('transaction_number', 'desc')->where('business_id', '=', $business_id)->first();
        if($last){
            $last_active = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - $last->date;
            $last_active = $last_active / 86400; //convert seconds to days
        }else{
            $last_active = null;
        }
        return $last_active;
    }

    public static function daysAgoActive($business_id) {
        $days = Analytics::getLastActive($business_id);
        if ($days > 7) {
            return "More than a week ago";
        }
        elseif ($days == 1) {
            return "Yesterday";
        }
        elseif ($days == 0) {
            return "Today";
        }
        else {
            return $days . " days ago";
        }
    }

    public static function getUserQueues($user_id = null){
        if($user_id){
            $results = Analytics::where('user_id', '=', $user_id)->get();
        }else{
            $results = Analytics::all();
        }

        foreach($results as $index => $data){
            $action = 'issued';
            if($data->action == 1 ) { $action = 'called'; }
            else if($data->action == 2 ) { $action = 'served'; }
            else if($data->action == 3 ) { $action = 'dropped'; }

            try{
                $user_data[$index][$action] = Business::name($data->business_id);
                $user_data[$index]['user_id'] = $data->user_id;
            }catch(Exception $e){
                $user_data[$index][$action] = 'Deleted Businesses';
                $user_data[$index]['user_id'] = $data->user_id;
            }
        }
        return $user_data;
    }

    public static function countBusinessNumbers( $start_date, $end_date, $action){

        $temp_start_date = mktime(0, 0, 0, date('m', $start_date), date('d', $start_date), date('Y', $start_date));
        $temp_end_date = mktime(0, 0, 0, date('m', $end_date), date('d', $end_date), date('Y', $end_date));

        return Analytics::where('date', '>=', $temp_start_date)->where('date','<=', $temp_end_date)->where('action','=',$action)->count();
    }

    public static function countNumbersByBusiness($business_id, $temp_start_date, $action){
        return Analytics::where('business_id','=',$business_id)->where('date', '=', $temp_start_date)->where('action','=',$action)->count();
    }

    public static function countIndustryNumbersWithData($business_id, $temp_start_date)
    {
        $count = [];

        for ($i = 0; $i < count($business_id); $i++) {
            $transaction_number_array = Analytics::where('business_id', '=', $business_id[$i]->business_id)->where('date', '=', $temp_start_date)->where('action', '=', 0)->lists('transaction_number');
            for ($i = 0; $i < count($transaction_number_array); $i++) {
                $temp_data = DB::table('priority_queue')->where('transaction_number', '=', $transaction_number_array[$i])->get();
                if ($temp_data[0]->name || $temp_data[0]->email || $temp_data[0]->phone) {
                    array_push($count, 1);
                }
            }
        }
        return array_sum($count);
    }

    public static function countCountryNumbersWithData($business_id, $temp_start_date)
    {

        $count = [];

        for ($i = 0; $i < count($business_id); $i++) {
            $transaction_number_array = Analytics::where('business_id', '=', $business_id[$i]->business_id)->where('date', '=', $temp_start_date)->where('action', '=', 0)->lists('transaction_number');
            for ($i = 0; $i < count($transaction_number_array); $i++) {
                $temp_data = DB::table('priority_queue')->where('transaction_number', '=', $transaction_number_array[$i])->get();
                if ($temp_data[0]->name || $temp_data[0]->email || $temp_data[0]->phone) {
                    array_push($count, 1);
                }
            }
        }
        return array_sum($count);
    }

    public static function countNumbersWithData($business_id, $temp_start_date){

        $transaction_number_array = Analytics::where('business_id','=',$business_id)->where('date', '=', $temp_start_date)->where('action','=',0)->lists('transaction_number');
        $count= [];

        for($i=0; $i < count($transaction_number_array); $i++) {
            $temp_data= DB::table('priority_queue')->where('transaction_number','=',$transaction_number_array[$i])->get();
            if($temp_data[0]->name || $temp_data[0]->email || $temp_data[0]->phone){
             array_push($count, 1);
            }
        }

        return array_sum($count);
    }

    public static function countNumbersByIndustry($business_id, $temp_start_date, $action){

        $count= [];

        for($i=0; $i < count($business_id); $i++){
            $temp_count = Analytics::where('business_id','=',$business_id[$i]->business_id)->where('date', '=', $temp_start_date)->where('action','=',$action)->count();
            array_push($count, $temp_count);
        }

        return array_sum($count);
    }

    public static function countNumbersByCountry($business_id, $temp_start_date, $action){

        $count = [];

        for($i=0; $i < count($business_id); $i++){

            $temp_count = Analytics::where('business_id','=',$business_id[$i]->business_id)->where('date', '=', $temp_start_date)->where('action','=',$action)->count();
            array_push($count, $temp_count);
        }

        return array_sum($count);
    }


    /**
     * New Time Estimates Algorithm
     *
     */
    public function getServiceTimeEstimates($service_id, $date = null){
        $date = $date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $date;
        $serving_times = $this->getServingTimes($service_id, $date);
        $all_numbers = ProcessQueue::allNumbers($service_id);
        $numbers_ahead = Analytics::getServiceRemainingCount($service_id);
        $next_number = $all_numbers->next_number;
        if(count($serving_times) > 1){
            $time = time();
            $mean = $this->getMean($serving_times);
            $standard_deviation = $this->getStandardDeviation($serving_times);
            $time_estimates = $this->getTimeEstimate($time, $numbers_ahead, $mean, $standard_deviation);

            $time_estimates['upper_limit'] = date('h:i A', $time_estimates['upper_limit']);
            $time_estimates['lower_limit'] = $time_estimates['lower_limit'] > $time ? date('h:ia', $time_estimates['lower_limit']) : date('h:i A', $time);
            $time_estimates['next_number'] = $next_number;
            $time_estimates['serving_times'] = $serving_times;
        }else{
            $time_estimates['upper_limit'] = date('h:i A', time());
            $time_estimates['lower_limit'] = date('h:i A', time());
            $time_estimates['next_number'] = $next_number;
            $time_estimates['numbers_ahead'] = $numbers_ahead;
        }

        return json_encode($time_estimates);
    }

    /**
     * @param $service_id
     * @return array $serving_times
     * get serving times of each transaction of service
     */
    private function getServingTimes($service_id, $date){
        $called_numbers = Analytics::where('service_id', '=', $service_id)
            ->where('date', '=', $date)
            ->where('action', '=', '1')
            ->get();
        $served_numbers = Analytics::where('service_id', '=', $service_id)
            ->where('date', '=', $date)
            ->where('action', '=', '2')
            ->get();

        $serving_times = [];
        foreach($called_numbers as $called){
            foreach($served_numbers as $served){
                if($called->transaction_number == $served->transaction_number){
                    $serving_times[] = ($served->action_time - $called->action_time);
                }
            }
        }
        //$serving_times = [10, 20, 30, 10, 20, 50, 40, 20];
        return $serving_times;
    }

    /**
     * @param $serving_times
     * @return float mean
     * get the mean of the entries given
     */
    private function getMean($serving_times){
        $sum = 0;
        $entries = count($serving_times);

        foreach($serving_times as $serving_time){
            $sum += $serving_time;
        }

        $mean = $sum / $entries;
        return $mean;
    }

    /**
     * @param $serving_times = array
     * @return standard deviation
     * get the standard deviation of the given serving times
     */
    private function getStandardDeviation($serving_times){
        $entries = count($serving_times);
        $sum_deviation = 0;
        $mean = $this->getMean($serving_times);
        foreach($serving_times as $serving_time){
            $sum_deviation += ($serving_time - $mean) * ($serving_time - $mean);
        }

        return sqrt($sum_deviation/ ($entries - 1));
    }

    /**
     * @param $time
     * @param $standard_deviation
     * @param int $accuracy\
     * @return array $estimate
     * get the time estimate using the given standard deviation
     */
    private function getTimeEstimate($time, $numbers_ahead, $mean, $standard_deviation, $accuracy = 2){
        $estimate = [
            'time' => $time,
            'mean' => $mean,
            'standard_deviation' => $standard_deviation,
            'lower_limit' => $time + (($numbers_ahead + 1) * $mean) - ($standard_deviation * $accuracy),
            'upper_limit' => $time + (($numbers_ahead + 1) * $mean) + ($standard_deviation * $accuracy),
            'numbers_ahead' => $numbers_ahead,
        ];

        return $estimate;
    }



}