<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2/3/15
 * Time: 6:53 PM
 */

class TerminalController extends BaseController{

    public function getAssign($fb_id, $terminal_id){
        $user_id = User::where('fb_id', '=', $fb_id)->first()->user_id;
        $login_id = TerminalManager::assignToTerminal($user_id, $terminal_id);
        $business = Business::getBusinessDetails(Business::getBusinessIdByTerminalId($terminal_id));
        return json_encode(['success' => 1 , 'login_id' => $login_id, 'business' => $business]);
    }

    public function getUnassign($user_id, $terminal_id){
        TerminalManager::unassignFromTerminal($user_id, $terminal_id);
        $business = Business::getBusinessDetails(Business::getBusinessIdByTerminalId($terminal_id));
        return json_encode(['success' => 1, 'business' => $business]);
    }
}