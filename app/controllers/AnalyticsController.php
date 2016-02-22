<?php
/**
 * Created by PhpStorm.
 * User: aunne
 * Date: 22/02/2016
 * Time: 12:41 PM
 */

class AnalyticsController extends BaseController{

    public function getBusinessAnalytics($business_id, $start_date = null, $end_date = null){
        $start_date = $start_date == null ? 0 : $start_date;
        $end_date = $end_date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $end_date;

        $business_package = 'pro'; // basic, plus, pro
        switch ($business_package){
            case 'pro':
                $data = $this->getProAnalytics($business_id, $start_date, $end_date);
                break;
            case 'plus':
                $data = $this->getPlusAnalytics($business_id, $start_date, $end_date);
                break;
            default:
                $data = $this->getBasicAnalytics($business_id, $start_date, $end_date);
                break;
        }

        return json_encode($data);

    }

    public function getBasicAnalytics($business_id, $start_date, $end_date){
        $data = [
            'total_numbers_issued' => Analytics::getTotalNumbersIssuedByBusinessId($business_id, $start_date, $end_date),
            'total_numbers_called' => Analytics::getTotalNumbersCalledByBusinessId($business_id, $start_date, $end_date),
            'total_numbers_dropped' => Analytics::getTotalNumbersDroppedByBusinessId($business_id, $start_date, $end_date),
            'total_numbers_served' => Analytics::getTotalNumbersServedByBusinessId($business_id, $start_date, $end_date),
            'average_waiting_time' => Analytics::getAverageTimeCalledByBusinessId($business_id, 'string', $start_date, $end_date),
            'average_serving_time' => Analytics::getAverageTimeServedByBusinessId($business_id, 'string', $start_date, $end_date),
        ];

        return $data;
    }

    public function getPlusAnalytics($business_id, $start_date, $end_date){
        $data = [
            'terminal_users' => [],
            'average_serving_time_per_terminal_user' => [],
            'peak_activity_graph' => [],
        ];

        return $data;
    }

    public function getProAnalytics($business_id, $start_date, $end_date){
        $basic = $this->getBasicAnalytics($business_id, $start_date, $end_date);
        $plus = $this->getPlusAnalytics($business_id, $start_date, $end_date);
        $data = [
            'staff_reports' => [],
        ];

        $data = array_merge($data, $plus);
        $data = array_merge($data, $basic);

        return $data;
    }
}