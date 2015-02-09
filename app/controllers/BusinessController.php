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
              "get_num": " ",
              "display": "6"
            }
        ';

        File::put(public_path() . '/json/' . $business->business_id . '.json', $contents);
        $business_user->save();

        $branch_id = Branch::createBusinessBranch( $business->business_id, $business->name );
        $service_id = Service::createBranchService( $branch_id, $business->name );

        /* @CSD Auto issue on business create */
        $issueController = new IssueNumberController();
        $issueController->getMultiple($service_id, 10);
        /* Auto issue end */

        $terminals = Terminal::createBranchServiceTerminal(Auth::user()->user_id, $service_id, $business->num_terminals);

        if ($business->save()){
            return json_encode([
                'success' => 1,
                'terminals' => $terminals
            ]);
        } else {
            return json_encode([
                'success' => 0,
            ]);
        }
    }

    /*
     * @author: CSD
     * @description: post edit business details
     * @return updated business row
     */
    public function postEditBusiness(){
        $business_data = Input::all();
        $business = Business::find($business_data['business_id']);

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

        $business->queue_limit = $business_data['queue_limit']; /* RDH Added queue_limit to Edit Business Page */

        $business->save();

        return json_encode([
            'success' => 1,
            'business' => $business
            ]);
    }

    public function getBusinessdetails($business_id){
        $business = Business::getBusinessDetails($business_id);
        return json_encode(['success' => 1, 'business' => $business]);
    }

    public function postFilterSearch() {
        $post = json_decode(file_get_contents("php://input"));
        $res = Business::getBusinessByNameCountryIndustryTimeopen($post->keyword, $post->country, $post->industry, $post->time_open);
        $arr = array();
        foreach ($res as $count => $data) {
            $arr[] = array(
                'business_id' => $data->business_id,
                'business_name' => $data->name,
                'local_address' => $data->local_address,
            );
        }
        return json_encode($arr);
    }

}