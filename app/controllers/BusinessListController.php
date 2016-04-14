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

    public function postSpreadsheetBusinessList(){

        $target_dir = public_path()."/files/";
        $target_file = $target_dir. basename($_FILES["business_list"]["name"]);

        if(move_uploaded_file($_FILES["business_list"]["tmp_name"], $target_file)) {

            $business_list_data = BusinessList::all();

            $inputFileType = PHPExcel_IOFactory::identify($target_file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($target_file);

            $sheet = $objPHPExcel->getSheet(0);
            $highest_row = $sheet->getHighestRow();
            $highest_column = $sheet->getHighestColumn();
            $business_name_column = 0;
            $name_index = 0;
            $local_address_index = 1;
            $email_index = 2;
            $phone_index = 3;
            $time_open_index = 4;
            $time_close_index = 5;

            $new_business_list = array();
            $updated_business_list = array();

            for ($row = 1; $row <= $highest_row; $row++) {
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row,NULL,TRUE,FALSE);

                $business_name_input = preg_replace('/[^a-z]/', "", strtolower($rowData[$name_index][$business_name_column]));

                foreach($business_list_data as $key=>$business){
                    $business_list_name = preg_replace('/[^a-z]/', "", strtolower($business['name']));
                    if($business_list_name === $business_name_input){
                        array_push($updated_business_list,
                            [
                                'business_list_id' => $business['business_list_id'],
                                'name' => $rowData[$business_name_column][$name_index],
                                'local_address' => $rowData[$business_name_column][$local_address_index],
                                'email' => $rowData[$business_name_column][$email_index],
                                'phone' => $rowData[$business_name_column][$phone_index],
                                'time_open' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_open_index],'h:i a'))),
                                'time_close' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_close_index],'h:i')))
                            ]
                        );
                        break;
                    }
                    if( $key+1 == count($business_list_data)){
                        if($rowData){

                            array_push($new_business_list, [
                                'name' => $rowData[$business_name_column][$name_index],
                                'local_address' => $rowData[$business_name_column][$local_address_index],
                                'email' => $rowData[$business_name_column][$email_index],
                                'phone' => $rowData[$business_name_column][$phone_index],
                                'time_open' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_open_index],'h:i a'))),
                                'time_close' => date('g:i A', strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[$business_name_column][$time_close_index],'h:i'))),
                                'business_id' => null,
                                'created_by' => Helper::userId()
                            ]);
                        }
                    }
                }
            };

            if(BusinessList::updateListByBatch($updated_business_list) && $new_business_list ? BusinessList::insert($new_business_list):true){
                return json_encode(['success' => 1]);
            }else{
                return json_encode(['success' => 0, 'error_message' =>'Something went wrong..']);
            }
        }else{
            return json_encode(['success' => 0, 'error_message' =>'Something went wrong..']);
        }

    }

}