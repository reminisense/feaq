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

        /*
        $business->queue_limit = $business_data['queue_limit'];
        $business->num_terminals = $business_data['num_terminals'];
        */

        /*
         * @author CSD
         * @description:
         * set default num terminals to 3 when creating a business
         * set default queue limit to 9999 max
         */
        $business->queue_limit = 9999;
        $business->num_terminals = 3;
        $business->save();

        $business_user = new UserBusiness();
        $business_user->user_id = $business_data['user_id'];
        $business_user->business_id = $business->business_id;

        date_default_timezone_set("Asia/Manila"); // Manila Timezone for now but this depends on business location

        $contents = '
            {
              "box1": {
                "number": "1",
                "terminal": "",
                "rank": ""
              },
              "box2": {
                "number": "2",
                "terminal": "",
                "rank": ""
              },
              "box3": {
                "number": "3",
                "terminal": "",
                "rank": ""
              },
              "box4": {
                "number": "4",
                "terminal": "",
                "rank": ""
              },
              "box5": {
                "number": "5",
                "terminal": "",
                "rank": ""
              },
              "box6": {
                "number": "6",
                "terminal": "",
                "rank": ""
              },
              "get_num": " ",
              "display": "6",
              "date": "' . date("mdy") . '"
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
        $business->fb_url = $business_data['facebook_url'];

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
        $business = Business::getBusinessDetails($business->business_id);

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

  public function postRemove() {
    $post = json_decode(file_get_contents("php://input"));
    Business::deleteBusinessByBusinessId($post->business_id);
    $branches = Branch::getBranchesByBusinessId($post->business_id);
    foreach ($branches as $count => $data) {
      $services = Service::getServicesByBranchId($data->branch_id);
      foreach ($services as $count2 => $data2) {
        $terminals = Terminal::getTerminalsByServiceId($data2->service_id);
        foreach ($terminals as $count3 => $data3) {
          TerminalUser::deleteUserByTerminalId($data3['terminal_id']);
        }
        Terminal::deleteTerminalsByServiceId($data2->service_id);
      }
      Service::deleteServicesByBranchId($data->branch_id);
    }
    Branch::deleteBranchesByBusinessId($post->business_id);
    UserBusiness::deleteUserByBusinessId($post->business_id);
    return json_encode(array('status' => 1));
  }
}