<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 4/6/2016
 * Time: 11:01 AM
 */

class BusinessListController extends BaseController
{

    public function getTransferBusinessToBusinessList(){

        $business_list = array();
        $businesses = Business::all();

        for($index = 0; $index < count($businesses); $index++){
            array_push($business_list,
                [
                    'name' => $businesses[$index]->name,
                    'local_address' => $businesses[$index]->local_address,
                    'email' => '',
                    'phone' => 0,
                    'business_id' => $businesses[$index]->business_id,
                    'created_by' => Helper::userId(),
                ]
            );
        }

        BusinessList::insert($business_list);
        return  "Success..";
    }

}