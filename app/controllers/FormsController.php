<?php

class FormsController extends BaseController{

  public function postAddTextfield() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) { // PAG added permission checking
      Forms::createField(array(
        'business_id' => Input::get('business_id'),
        'field_type' => 'Text Field',
        'field_data' => serialize(array(
          'label' => Input::get('text_field_label'),
        )),
      ));
      return json_encode(array('form_fields' => $this->getFields(Input::get('business_id'))));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

  public function postAddRadiobutton() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) { // PAG added permission checking
      $form_id = Forms::createField(array(
        'business_id' => Input::get('business_id'),
        'field_type' => 'Radio',
        'field_data' => serialize(array(
          'label' => Input::get('radio_button_label'),
          'value_a' => Input::get('radio_value_a'),
          'value_b' => Input::get('radio_value_b'),
        )),
      ));
      return json_encode(array('form_id' => $form_id));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

  public function postAddCheckbox() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) { // PAG added permission checking
      $form_id = Forms::createField(array(
        'business_id' => Input::get('business_id'),
        'field_type' => 'Checkbox',
        'field_data' => serialize(array(
          'label' => Input::get('checkbox_label'),
        )),
      ));
      return json_encode(array('form_id' => $form_id));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

  public function postAddDropdown() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) { // PAG added permission checking
      $options = preg_split('/\r\n|[\r\n]/', Input::get('dropdown_options'));
      $form_id = Forms::createField(array(
        'business_id' => Input::get('business_id'),
        'field_type' => 'Dropdown',
        'field_data' => serialize(array(
          'label' => Input::get('dropdown_label'),
          'options' => serialize($options),
        )),
      ));
      return json_encode(array('form_id' => $form_id));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

  public function postDisplayFields() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId()) || Helper::userId() != 0) { // PAG added permission checking
      $fields = $this->getFields(Input::get('business_id'));
      if (!count($fields)) {
        $fields = 0;
      }
      return json_encode(array('form_fields' => $fields));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }

  public function getFields($business_id) {
    $fields = array();
    $res = Forms::getFieldsByBusinessId($business_id);
    foreach ($res as $count => $data) {
      $field_data = unserialize($data->field_data);
      $fields[$data->form_id] = array(
        'field_type' => $data->field_type,
        'label' => $field_data['label'],
        'options' => array_key_exists('options', $field_data) ? unserialize($field_data['options']) : array(),
        'value_a' => array_key_exists('value_a', $field_data) ? $field_data['value_a'] : '',
        'value_b' => array_key_exists('value_b', $field_data) ? $field_data['value_b'] : '',
      );
    }
    return $fields;
  }

  public function postDeleteField() {
    if (Helper::isBusinessOwner(Input::get('business_id'), Helper::userId())) { // PAG added permission checking
      Forms::deleteField(Input::get('form_id'));
      return json_encode(array('status' => 1));
    }
    else {
      return json_encode(array('message' => 'You are not allowed to access this function.'));
    }
  }
    public function postConvertToFormat(){

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $custom_fields = $_POST['custom_fields'];
        $format = $_POST['data-format'];

        if($format == "json") {
            header('Content-disposition: attachment; filename=data.json');
            header('Content-type: application/json');


            $json_contents = json_encode(array(
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'custom_fields' => $custom_fields
            ));

            echo $json_contents;

        
//        }else if ($format == "xml"){
//
//        }else if ($format == "csv") {
//
//
////            header("Content-Type: text/csv");
////            header("Content-Disposition: attachment; filename=file.csv");
////            // Disable caching
////            header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
////            header("Expires: 0"); // Proxies
//
//
//            $data = [
//                'name' => $name,
//                'phone' => $phone,
//                'email' => $email
//            ];
////                'custom_fields'=>$custom_fields
//
//
//
//            var_dump($data);
//
//            $output = fopen("php://output", "w");
//            foreach ($data as $row) {
//                var_dump($row);
////                fputcsv($output, $row); // here you can change delimiter/enclosure
//            }
//
//            fclose($output);
////
////            $fp = fopen($csv_file, 'w');
////            fputcsv($fp, array_keys($input));
////            fputcsv($fp,$input);
////            fclose($fp);
//
////
        }

//


//        $json_file = public_path() . '/form-data.json';
//        $csv_file = public_path() . '/form-data.csv';
//        $xml_file = public_path() . '/form-data.xml';
//
//        //Saves CSV
//        $fp = fopen($csv_file, 'w');
//        fputcsv($fp, array_keys($input));
//        fputcsv($fp,$input);
//        fclose($fp);
//
//        //Saves JSON
//        file_put_contents($json_file, json_encode($input, JSON_PRETTY_PRINT));
//
//        //Saves XML
//        $xml = new SimpleXMLElement('<data/>');
//        foreach($array as $key => $value) {
//            if(is_array($value)) {
//                if(!is_numeric($key)){
//                    $subnode = $xml_user_info->addChild("$key");
//                    array_to_xml($value, $subnode);
//                }else{
//                    $subnode = $xml_user_info->addChild("item$key");
//                    array_to_xml($value, $subnode);
//                }
//            }else {
//                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
//            }
//        }
//        Helper::array_to_xml($input,$xml);
//
//        $dom = dom_import_simplexml($xml)->ownerDocument;
//        $dom->formatOutput = true;
//        $dom->save($xml_file);

//        return json_encode(['success' => 1]);
    }

}