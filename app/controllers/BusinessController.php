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
     * @return success on successful business create
     */
    public function postSetupBusiness()
    {
        $business_data = $_POST;

        $business = new Business();
        $business->name = $business_data['business_name'];
        $business->local_address = $business_data['business_address'];
        $business->industry = $business_data['industry'];

        $time_open_arr = Helper::parseTime($business_data['time_open']);
        $business->open_hour = $time_open_arr['hour'];
        $business->open_minute = $time_open_arr['min'];
        $business->open_ampm = $time_open_arr['ampm'];

        $time_close_arr = Helper::parseTime($business_data['time_close']);
        $business->close_hour = $time_close_arr['hour'];
        $business->close_minute = $time_close_arr['min'];
        $business->close_ampm = $time_close_arr['ampm'];

        $business->queue_limit = $business_data['queue_limit'];
        $business->num_terminals = $business_data['num_terminals'];
        $business->save();

        $business_user = new UserBusiness();
        $business_user->user_id = $business_data['user_id'];
        $business_user->business_id = $business->business_id;

        $contents = '
            {
              "box1": {
                "number": "1",
                "terminal": ""
              },
              "box2": {
                "number": "2",
                "terminal": ""
              },
              "box3": {
                "number": "3",
                "terminal": ""
              },
              "box4": {
                "number": "4",
                "terminal": ""
              },
              "box5": {
                "number": "5",
                "terminal": ""
              },
              "box6": {
                "number": "6",
                "terminal": ""
              },
              "get_num": "1"
            }
        ';

        File::put(public_path() . '/json/' . $business->business_id . '.json', $contents);
        $business_user->save();

        $branch_id = Branch::createBusinessBranch( $business->business_id, $business->name );
        $service_id = Service::createBranchService( $branch_id, $business->name );

        $terminals = Terminal::createBranchServiceTerminal($branch_id, $service_id, $business->num_terminals);

        if ($business->save()){
            return json_encode([
                'success' => 1,
            ]);
        } else {
            return json_encode([
                'success' => 0,
            ]);
        }
    }

    /*
     * @author: CSD
     * @description: parse time input for database field
     * @return: associative array of time details (hour, min, ampm)
     */
    private function parseTime($time)
    {
        $arr = explode(' ', $time);
        $hourmin = explode(':', $arr[0]);

        return [
            'hour' => trim($hourmin[0]),
            'min'  => trim($hourmin[1]),
            'ampm' => trim($arr[1]),
        ];
    }

    public function getBusinessdetails($business_id){
        $business = Business::getBusinessDetails($business_id);
        return json_encode(['success' => 1, 'business' => $business]);
    }

}