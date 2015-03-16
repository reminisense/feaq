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

    public function getDelete($terminal_id){
        $business_id = Business::getBusinessIdByTerminalId($terminal_id);
        $error = 'There are still pending numbers for this terminal.';
        if(TerminalTransaction::terminalActiveNumbers($terminal_id) == 0){
            Terminal::deleteTerminal($terminal_id);
            $error = null;
        }
        $business = Business::getBusinessDetails($business_id);
        $business['error'] = $error;
        return json_encode(['success' => 1, 'business' => $business]);

    }

    public function postCreate($business_id){
        $name = Input::get('name');
        $terminal_id = count(Terminal::getTerminalsByBusinessId($business_id));

       if($this->validateTerminalName($business_id,$name,$terminal_id)){
            Terminal::createBusinessNewTerminal($business_id, $name);
            $business = Business::getBusinessDetails($business_id);
            return json_encode(['success' => 1, 'business' => $business]);
       }else{
            return json_encode(['status' => 0]);
       }
    }

    public function postEdit() {
        $post = json_decode(file_get_contents("php://input"));
        $business_id = Business::getBusinessIdByTerminalId($post->terminal_id);
        if($this->validateTerminalName($business_id,$post->name,$post->terminal_id)){
            Terminal::setName($post->terminal_id, $post->name);
            return json_encode(array('status' => 1));
        }else{
            return json_encode(array('status' => 0));
        }
    }

    public function validateTerminalName($business_id, $input_terminal_name, $terminal_id){
        $terminals = Terminal::getTerminalsByBusinessId($business_id);

        foreach($terminals as $terminal){
            if($terminal['terminal_id'] != $terminal_id && str_replace(' ', '', strtolower($terminal['name'])) == str_replace(' ', '', strtolower($input_terminal_name))){
                return false;
            }
        }
        return true;
    }
}