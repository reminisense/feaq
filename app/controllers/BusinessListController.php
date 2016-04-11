<?php
/**
 * Created by PhpStorm.
 * User: JONAS
 * Date: 4/6/2016
 * Time: 11:01 AM
 */

class BusinessListController extends BaseController
{

    public function getIndex(){
        return View::make('business-list');
    }
    
    public function getImportToList(){

        $business_list = array();
        $businesses = Business::all();

        for($index = 0; $index < count($businesses); $index++){
            array_push($business_list,
                [
                    'name' => $businesses[$index]->name,
                    'local_address' => $businesses[$index]->local_address,
                    'email' => '',
                    'phone' => 0,
                    'time_open' => date("H:i", mktime($businesses[$index]->open_hour, $businesses[$index]->open_minute, 0, 0, 0, 0))." ".$businesses[$index]->open_ampm,
                    'time_close' => date("H:i", mktime($businesses[$index]->close_hour, $businesses[$index]->close_minute, 0, 0, 0, 0))." ".$businesses[$index]->close_ampm,
                    'business_id' => $businesses[$index]->business_id,
                    'created_by' => Helper::userId(),
                ]
            );
        }

        BusinessList::insert($business_list);
        return  "Success..";
    }

}