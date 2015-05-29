<?php

class FormsController extends BaseController{

  public function postAddTextfield() {
    Forms::createField(array(
      'business_id' => Input::get('business_id'),
      'field_type' => 'Text Field',
      'field_data' => serialize(array(
        'label' => Input::get('text_field_label'),
      )),
    ));
    return json_encode(array('form_fields' => $this->getFields(Input::get('business_id'))));
  }

  public function postAddRadiobutton() {
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

  public function postAddCheckbox() {
    $form_id = Forms::createField(array(
      'business_id' => Input::get('business_id'),
      'field_type' => 'Checkbox',
      'field_data' => serialize(array(
        'label' => Input::get('checkbox_label'),
      )),
    ));
    return json_encode(array('form_id' => $form_id));
  }

  public function postAddDropdown() {
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

  public function postDisplayFields() {
    return json_encode(array('form_fields' => $this->getFields(Input::get('business_id'))));
  }

  private function getFields($business_id) {
    $fields = array();
    $res = Forms::getFieldsByBusinessId($business_id);
    foreach ($res as $count => $data) {
      $label = unserialize($data->field_data);
      $label = $label['label'];
      $fields[$data->form_id] = array(
        'field_type' => $data->field_type,
        'label' => $label,
      );
    }
    return $fields;
  }

}