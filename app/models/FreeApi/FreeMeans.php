<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 1/16/17
 * Time: 3:50 PM
 */
class FreeMeans
{

  public function postUpdateMeanweights($data = array()) {
    $service_id = $data['service_id'];
    unset($data['service_id']);
    MeanServingTime::updateMeans($data, $service_id);
    return json_encode(['status' => 201, 'msg' => 'OK']);
  }

  public function getMeanWeights($service_id) {
//        $data = array();
    $means = MeanServingTime::fetchMeans($service_id);
//        foreach ($means as $count => $mean) {
//            $data['mean_today'] = $means->mean_today;
//            $data['mean_yesterday'] = $means->mean_yesterday;
//            $data['mean_three_days'] = $means->mean_three_days;
//            $data['mean_this_week'] = $means->mean_this_week;
//            $data['mean_last_week'] = $means->mean_last_week;
//            $data['mean_this_month'] = $means->mean_this_month;
//            $data['mean_last_month'] = $means->mean_last_month;
//            $data['mean_most_likely'] = $means->mean_most_likely;
//            $data['mean_most_optimistic'] = $means->mean_most_optimistic;
//            $data['mean_most_pessimistic'] = $means->mean_most_pessimistic;
//            $data['weight_today'] = $means->weight_today;
//            $data['weight_yesterday'] = $means->weight_yesterday;
//            $data['weight_three_days'] = $means->weight_three_days;
//            $data['weight_this_week'] = $means->weight_this_week;
//            $data['weight_last_week'] = $means->weight_last_week;
//            $data['weight_this_month'] = $means->weight_this_month;
//            $data['weight_last_month'] = $means->weight_last_month;
//            $data['weight_most_likely'] = $means->weight_most_likely;
//            $data['weight_most_optimistic'] = $means->weight_most_optimistic;
//            $data['weight_most_pessimistic'] = $means->weight_most_pessimistic;
//            $data['last_changed'] = $means->last_changed;
//            $data['final_mean'] = $means->final_mean;
//        }
    return json_encode($means);
  }

}