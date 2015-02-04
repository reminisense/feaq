<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/3/15
 * Time: 6:53 PM
 */

class TerminalController extends BaseController{

    public function getAssign($user_id, $terminal_id){
        TerminalUser::assignTerminalUser($user_id, $terminal_id);
        $business = Business::getBusinessDetails(Business::getBusinessIdByTerminalId($terminal_id));
        return json_encode(['success' => 1, 'business' => $business]);
    }

    public function getUnassign($user_id, $terminal_id){
        TerminalUser::unassignTerminalUser($user_id, $terminal_id);
        $business = Business::getBusinessDetails(Business::getBusinessIdByTerminalId($terminal_id));
        return json_encode(['success' => 1, 'business' => $business]);
    }
}