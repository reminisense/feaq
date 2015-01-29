<?php
/**
 *
 * Should contain business related functions
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:10 PM
 */


class BusinessController extends BaseController{

    /*
     * @author: CSD
     * @description: post business data from initial setup modal form
     *
     */
    public function postSetupBusiness()
    {
        $business_data = $_POST;

        $business = new Business();
        $business->name = $business_data['business_name'];
        $business->local_address = $business_data['business_address'];
        $business->industry = $business_data['industry'];
        $business->email = $business_data['email'];

        $time_open = $business_data['time_open'];
        $time_close = $business_data['time_close'];

        return json_encode([
            'time_open' => $time_open,
            'time_open' => $time_close,
        ]);


        $time_open = $this->parseTime($time_open);
        $time_close = $this->parseTime($time_close);


    }

    private function parseTime($time)
    {

    }
}