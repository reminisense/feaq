<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/10/15
 * Time: 4:51 PM
 */

class Analytics extends Eloquent{
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

    public static function insertAnalyticsQueueNumber($action, $transaction_number, $service_id, $date, $time, $terminal_id = 0){
        $values = [
            'transaction_number' => $transaction_number,
            'date' => $date,
            'business_id' => Business::getBusinessIdByServiceId($service_id),
            'branch_id' => Service::branchId($service_id),
            'service_id' => $service_id,
            'terminal_id' => $terminal_id,
            'queue_platform' => 'web',
            'user_id' => Helper::userId(),
            'action' => $action,
            'action_time' => $time
        ];

        Analytics::saveQueueAnalytics($values);

    }

    public static function insertAnalyticsQueueNumberIssued($transaction_number, $service_id, $date, $time){
        Analytics::insertAnalyticsQueueNumber(0, $transaction_number, $service_id, $date, $time);
    }

    public static function insertAnalyticsQueueNumberCalled($transaction_number, $service_id, $date, $time, $terminal_id){
        Analytics::insertAnalyticsQueueNumber(1, $transaction_number, $service_id, $date, $time, $terminal_id);
    }

    public static function insertAnalyticsQueueNumberServed($transaction_number, $service_id, $date, $time, $terminal_id){
        Analytics::insertAnalyticsQueueNumber(2, $transaction_number, $service_id, $date, $time, $terminal_id);
    }

    public static function insertAnalyticsQueueNumberRemoved($transaction_number, $service_id, $date, $time, $terminal_id){
        Analytics::insertAnalyticsQueueNumber(3, $transaction_number, $service_id, $date, $time, $terminal_id);
    }

    /**
     * requires an array of arrays
     * ex. 'field' => array('conditional_operator', 'value')
     * @param $conditions
     * @return mixed
     */
    public static function getQueueAnalyticsRows($conditions){
        $query = DB::table('queue_analytics');
        foreach($conditions as $field => $value){
            if(is_array($value)){
                $query->where($field, $value[0], $value[1]);
            }else{
                $query->where($field, '=', $value);
            }
        }
        return $query->get();
    }

    public static function getBusinessAnalytics($business_id){
        $analytics = [
            'Remaining Numbers in Queue' => Analytics::getBusinessRemainingCount($business_id),
            'Total Numbers Issued' => Analytics::getTotalNumbersIssuedByBusinessId($business_id),
            'Total Numbers Called' => Analytics::getTotalNumbersCalledByBusinessId($business_id),
            'Total Numbers Served' => Analytics::getTotalNumbersServedByBusinessId($business_id),
            'Total Numbers Dropped' => Analytics::getTotalNumbersDroppedByBusinessId($business_id),
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

    public static function getTotalNumbersServedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 2], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersDroppedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['=', 3], 'business_id' => ['=', $business_id ]]));
    }

    public static function getTotalNumbersProcessedByBusinessId($business_id){
        return count(Analytics::getQueueAnalyticsRows(['action' => ['>', 1], 'business_id' => ['=', $business_id ]]));
    }

    public static function getAverageTimeServedByBusinessId($business_id){
        return Analytics::getAverageTimeFromActionByBusinessId(1, 2, $business_id);
    }

    public static function getAverageTimeFromActionByBusinessId($action1, $action2, $business_id){
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
        return Helper::millisecondsToHMSFormat($average);
    }

}