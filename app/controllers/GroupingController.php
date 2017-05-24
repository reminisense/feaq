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
        $groupId = Input::get();
        return Grouping::deleteGroup($groupId);
    }

    public function postCreateGroup(){
        $groupId = Input::get();
        return Grouping::createGroup($groupId);
    }
}