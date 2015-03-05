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
        $business_check = Business::businessExistsByNameByAddress($business_data['business_name'], $business_data['business_address']);

        if (count($business_check) != 1){
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
                  "display": "1-6",
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
                    'error' => 'Something went wrong while saving your business.'
                ]);
            }
        } else {
            $error = "Business name already exists with the same business address.";
            return json_encode([
                'success' => 0,
                'error' => $error
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

        if($this->validateBusinessNameBusinessAddress($business, $business_data)){
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

            //ARA For queue settings terminal-specific numbers
            $queue_settings = new QueueSettingsController();
            $queue_settings->getUpdate($business['business_id'], 'number_limit', $business_data['queue_limit']);
            $queue_settings->getUpdate($business['business_id'], 'terminal_specific_issue', $business_data['terminal_specific_issue']);
            $queue_settings->getUpdate($business['business_id'], 'frontline_sms_secret', $business_data['frontline_sms_secret']);
            $queue_settings->getUpdate($business['business_id'], 'frontline_sms_url', $business_data['frontline_sms_url']);
            $business = Business::getBusinessDetails($business->business_id);
            return json_encode([
                'success' => 1,
                'business' => $business
            ]);
        } else {
            return json_encode([
                'success' => 0,
                'error' => 'Business name already exists with the same business address.'
            ]);
        }
    }

    public function getPdfDownload($business_id){
        $business_name = Business::name($business_id);
        $business_address = Business::localAddress($business_id);

        $qr_link = "https://api.qrserver.com/v1/create-qr-code/?data=" . Request::url() ."&size=302x302";

        $data = [
            'business_name' => $business_name,
            'business_address' => $business_address,
            'qr_code' => $qr_link
        ];

        $pdf = PDF::loadView('pdf.pdftemplate', $data);
        return $pdf->stream($business_name . '.pdf');
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

    /*
     * @author: CSD
     * @description:
     * checks if business name or business address input is different from db data,
     * if different validate if it exists or not
     *
     */
    private function validateBusinessNameBusinessAddress($dbBusiness, $inputBusiness){
        if ($dbBusiness->name != $inputBusiness['business_name'] || $dbBusiness->local_address != $inputBusiness['business_address']){
            $row = Business::businessExistsByNameByAddress($inputBusiness['business_name'], $inputBusiness['business_address']);
            if(count($row) == 0){
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

  public function getBroadcast($business_id = 0) {
    return View::make('tests.broadcast')
      ->with('business_id', $business_id);
  }
}