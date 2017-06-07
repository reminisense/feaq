<?php

class PacingController extends \BaseController
{

    public function getAllPaces($service_id)
    {
        return Pacing::fetchPacesByService($service_id);
    }

    public function postDeletePace($pace_id)
    {
        Pacing::deletePace($pace_id);
        return json_encode(array('status' => 1, 'msg' => 'SUCCESS'));
    }

    public function postCreatePace()
    {
        $data = array(
          'service_id' => Input::get('service_id'),
          'quota'      => Input::get('quota'),
          'time_start' => Input::get('time_start'),
          'time_end'   => Input::get('time_end'),
        );
        Pacing::createPace($data);
        return json_encode(array('status' => 1, 'msg' => 'SUCCESS'));
    }

}
