<?php

class FormsController extends BaseController{

    public function postSaveForm(){
        if (Helper::isBusinessOwner(Business::getBusinessIdByServiceId(Input::get('service_id')), Helper::userId())) { // PAG added permission checking

            $service_id = Input::get('service_id');
            $name = Input::get('name');
            $fields = Input::get('fields');
            $form_tag = count(Forms::fetchFormsByServiceId($service_id))+1;
            $path = 'public/xml/form_'.$service_id.'_'.$form_tag.'.xml';

            $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><data></data>");

            Helper::array_to_xml($fields,$xml);

            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom->formatOutput = true;
            $dom->saveXML();
            file_put_contents($path, $dom->saveXML());

            Forms::postCreateForm($service_id ,$name,serialize($fields), $path);
            return json_encode(array('success'=>1));
        }
    }
}