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

    //JCA added this for the business_list table when creating a business
    public function getNameSearch($keyword)
    {
        $businesses = BusinessList::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('local_address', 'LIKE', '%' . $keyword . '%')
            ->select(array('name', 'local_address','business_id'))
            ->get()
            ->toArray();
        return json_encode(array('keywords' => $businesses));
    }

    public function postCreateBusinessList(){

        if (Auth::check() && Helper::isNotAnOwner(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = new BusinessList();

            $business_list->name = $business_list_data['business_name'];
            $business_list->local_address = $business_list_data['business_address'];
            $business_list->email = $business_list_data['email'];
            $business_list->time_open = $business_list_data['time_open'];
            $business_list->time_close = $business_list_data['time_close'];
            $business_list->phone = $business_list_data['phone'];
            $business_list->created_by = Helper::userId();


            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                     'error' => 'Something went wrong while saving your business.'
                ]);
            }
        }
    }

    public function postEditBusinessList(){

        if (Auth::check() && Helper::isNotAnOwner(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = BusinessList::find($business_list_data['business_list_id']);

            $business_list->name = $business_list_data['business_name'];
            $business_list->local_address = $business_list_data['business_address'];
            $business_list->email = $business_list_data['email'];
            $business_list->time_open = $business_list_data['time_open'];
            $business_list->time_close = $business_list_data['time_close'];
            $business_list->phone = $business_list_data['phone'];
            $business_list->created_by = Helper::userId();


            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while saving your business.'
                ]);
            }
        }
    }

    public function postDeleteBusinessList(){

        if (Auth::check() && Helper::isNotAnOwner(Helper::userId())) {

            $business_list_data = Input::all();
            $business_list = BusinessList::find($business_list_data['business_list_id']);

            $business_list->deleted_at = date('Y-m-d G:i:s');

            if($business_list->save()){
                return json_encode([
                    'success' => 1
                ]);
            }else{
                return json_encode([
                    'success' => 0,
                    'error' => 'Something went wrong while saving your business.'
                ]);
            }
        }
    }

    public function postSpreadsheetBusinessList(){

        $target_dir = public_path()."/files/";
        $target_file = $target_dir. basename($_FILES["business_list"]["name"]);

//        if(move_uploaded_file($_FILES["business_list"]["tmp_name"], $target_file)) {
//
//            $inputFileType = PHPExcel_IOFactory::identify($target_file);
//            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
//            $objPHPExcel = $objReader->load($target_file);
//
//
//        }

        $business_list_data = BusinessList::all();

        $inputFileType = PHPExcel_IOFactory::identify($target_file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($target_file);

        $sheet = $objPHPExcel->getSheet(0);
        $highest_row = $sheet->getHighestRow();
        $highest_column = $sheet->getHighestColumn();
        $business_name_column = 0;
        $first_element_index = 0;

        $new_business_list = new BusinessList();
        $updated_business_list = [];

        for ($row = 1; $row <= $highest_row; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row,NULL,TRUE,FALSE);

            $business_name_input = preg_replace('/[^a-z]/', "", strtolower($rowData[$first_element_index][$business_name_column]));


            foreach($business_list_data as $business){
                $business_list_name = preg_replace('/[^a-z]/', "", strtolower($business['name']));
                if($business_list_name === $business_name_input){

                }
            }



        };

       return json_encode(['success' => 1]);
    }

}