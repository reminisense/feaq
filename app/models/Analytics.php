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
            $uncalled_numbers = Analytics::getBranchRemainingCount($branch->branch_id);
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

    public static function getBusinessAnalytics($business_id){
        $analytics = [
            'remaining_count' => Analytics::getBusinessRemainingCount($business_id),
            'total_numbers_issued' => Analytics::getTotalNumbersIssuedByBusinessId($business_id),
            'total_numbers_called' => Analytics::getTotalNumbersCalledByBusinessId($business_id),
            'total_numbers_served' => Analytics::getTotalNumbersServedByBusinessId($business_id),
            'total_numbers_dropped' => Analytics::getTotalNumbersDroppedByBusinessId($business_id),
            'average_time_called' => Analytics::getAverageTimeCalledByBusinessId($business_id),
            'average_time_served' => Analytics::getAverageTimeServedByBusinessId($business_id)
        ];

        return $analytics;
    }


    /**
     * individual queries
     */

    /*time served*/

    public static function getTotalNumbersIssuedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 0], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersCalledByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 1], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersCalledByBusinessIdWithDate($business_id, $startdate, $enddate){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 1], 'business_id' => ['=', $business_id ], 'date' => ['>=', $startdate], 'date' => ['<=', $enddate]]));
    }

    public static function getTotalNumbersServedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 2], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersDroppedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 3], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersProcessedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['>', 1], 'business_id' => ['=', $business_id ]]));
    }

    public static function getAverageTimeCalledByBusinessId($business_id, $format = 'string'){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByBusinessId(0, 1, $business_id);
        }else{
            return Analytics::getAverageTimeValueFromActionByBusinessId(0, 1, $business_id);
        }
    }

    public static function getAverageTimeServedByBusinessId($business_id, $format = 'string'){
        if($format === 'string'){
            return Analytics::getAverageTimeFromActionByBusinessId(1, 2, $business_id);
        }else{
            return Analytics::getAverageTimeValueFromActionByBusinessId(1, 2, $business_id);
        }
    }

    //gets the string representation of the average time
    public static function getAverageTimeFromActionByBusinessId($action1, $action2, $business_id){
        return Helper::millisecondsToHMSFormat(Analytics::getAverageTimeValueFromActionByBusinessId($action1, $action2, $business_id));
    }

    //gets the numeric representation of the average time
    public static function getAverageTimeValueFromActionByBusinessId($action1, $action2, $business_id){
        $action1_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action1], 'business_id' => ['=', $business_id ]]);
        $action2_numbers = Analytics::getQueueAnalyticsRows(['action' => ['=', $action2], 'business_id' => ['=', $business_id ]]);
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

    /**
     * ARA Computes for the time the next available number has to wait in order to be called
     * equation : time_to_be_called = average_calling_time x numbers_remaining_in_queue
     */
    public static function getWaitingTime($business_id){
        $numbers_in_queue = Analytics::getBusinessRemainingCount($business_id);
        $average_waiting_time = Analytics::getAverageTimeCalledByBusinessId($business_id, 'numeric');
        return $average_waiting_time * $numbers_in_queue;
    }

    public static function getWaitingTimeString($business_id){
        $waiting_time = Analytics::getWaitingTime($business_id);
        $waiting_time = floor($waiting_time / 60);

        if($waiting_time > 60){
            $waiting_time_string = 'Approx. more than 1 hr';
        }else if($waiting_time <= 60 && $waiting_time > 45){
            $waiting_time_string = '45-60 mins';
        }else if($waiting_time <= 45 && $waiting_time > 30){
            $waiting_time_string = '30-45 mins';
        }else if($waiting_time <= 30 && $waiting_time > 15){
            $waiting_time_string = '15-30 mins';
        }else if($waiting_time <= 15 && $waiting_time > 10){
            $waiting_time_string = '10-15 mins';
        }else if($waiting_time <= 10 && $waiting_time > 5){
            $waiting_time_string = '5-10 mins';
        }else if($waiting_time <= 5 && $waiting_time > 0){
            $waiting_time_string = '1-5 mins';
        }else{
            $waiting_time_string = 'No line.';
        }

        return $waiting_time_string;
    }

}