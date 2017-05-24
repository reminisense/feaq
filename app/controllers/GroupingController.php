<?php

/**
 * Created by PhpStorm.
 * User: Polljii143
 * Date: 5/24/17
 * Time: 5:08 PM
 */
class GroupingController extends BaseController
{
    public function getGroups($business_id){
        return Grouping::fetchGroupsByBusiness($business_id);
    }

    public function postDeleteGroup() {
        Grouping::deleteGroup(Input::get('group_id'));
        return json_encode(array('status' => 1, 'msg' => 'SUCCESS'));
    }

    public function postCreateGroup(){
        $data = array(
          'group_name' => Input::get('group_name'),
          'business_id' => Input::get('business_id')
        );
        if (!Grouping::isGroupExists(Input::get('group_name'))) {
            Grouping::createGroup($data);
            return json_encode(array('status' => 1, 'msg' => 'SUCCESS'));
        }
        return json_encode(array('status' => 0, 'msg' => 'Group name already taken.'));
    }
}