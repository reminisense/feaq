<?php
/**
 * Created by PhpStorm.
 * User: aunne
 * Date: 22/02/2016
 * Time: 12:41 PM
 */

class AnalyticsController extends BaseController{

    public function getBusinessAnalytics($business_id, $start_date = null, $end_date = null){
        Log::info('Getting Business Analytics.');
        $start_date = $start_date == null ? 0 : $start_date;
        $end_date = $end_date == null ? mktime(0, 0, 0, date('m'), date('d'), date('Y')) : $end_date;

        $business = Business::where('business_id', '=', $business_id)->first();
        $business_features = unserialize($business->business_features);
        $business_package = $business_features['package_type']; // basic, plus, pro
        switch ($business_package){
            case 'Pro':
                Log::info('Obtaining business analytics for pro package.');
                $data = Analytics::getProAnalytics($business_id, $start_date, $end_date);
                break;
            case 'Plus':
                Log::info('Obtaining business analytics for plus package.');
                $data = Analytics::getPlusAnalytics($business_id, $start_date, $end_date);
                break;
            default:
                Log::info('Obtaining business analytics for basic package.');
                $data = Analytics::getBusinessAnalytics($business_id, $start_date, $end_date);
                break;
        }

        return json_encode($data);

    }
}