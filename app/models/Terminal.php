<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:22 PM
 */

class Terminal extends Eloquent{

    protected $table = 'terminal';
    protected $primaryKey = 'terminal_id';
    public $timestamps = false;

    public static function createTerminal($service_id, $name){
        $colors = array('', 'blue', 'borange', 'violet', 'green', 'red', 'yellow', 'cyan', 'x242436', 'x78250A', 'FF745F', 'FCA78B', 'x53777A', 'x542437', 'C02942', 'D95B43', 'ECD078');
        $serviceCount = Terminal::generateTerminalColor($service_id, $colors);
        $terminal = new Terminal();
        $terminal->name = $name;
        $terminal->service_id = $service_id;
        $terminal->status = 1;
        $terminal->box_rank = Terminal::generateBoxRank($service_id); // Added by PAG
        $terminal->color = $colors[$serviceCount];
        $terminal->save();
        Helper::dbLogger('Terminal', 'terminal', 'insert', 'createTerminal', User::email(Helper::userId()), 'terminal_id:' . $terminal->terminal_id);

        return $terminal;
    }

    private static function generateTerminalColor($service_id, $colors) {
        $business_id = Business::getBusinessIdByServiceId($service_id);
        $services = Service::getServicesByBusinessId($business_id);
        $arrSize = count($colors);
        $serviceCount = 0;
        foreach ($services as $count => $service) {
            if ($service->service_id == $service_id) {
                $serviceCount = $count;
                if ($serviceCount > $arrSize) {
                    $serviceCount = $serviceCount % $arrSize;
                }
                break;
            }
        }
        return $serviceCount + 1;
    }

    /*
     * @author: CSD
     * @description: create terminal on business creation/setup
     * @return none
     */
    public static function createBranchServiceTerminal($user_id, $service_id, $num){
        $terminals = [];
        for($i = 1; $i <= $num; $i++){
            $terminal = Terminal::createTerminal($service_id, "Terminal " . $i);
            $terminaluser = new TerminalUser();
            $terminaluser->user_id = $user_id;
            $terminaluser->terminal_id = $terminal->terminal_id;
            $terminaluser->status = 1;
            $terminaluser->date = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $terminaluser->save();

            array_push($terminals, $terminal);
        }

        return $terminals;
    }

    /*
     * @author: CSD
     * @description: fetch terminals by service id
     * @return: terminal array by service id
     */
    public static function getTerminalsByServiceId($service_id){
        return Terminal::where('service_id', '=', $service_id)->get()->toArray();
    }

    public static function name($terminal_id){
        return Terminal::find($terminal_id)->name;
    }

    public static function serviceId($terminal_id){
        return Terminal::find($terminal_id)->service_id;
    }

    public static function getTerminalsByBranchId($branch_id){
        $services = Service::where('branch_id', '=', $branch_id)->get();
        $terminals = [];
        foreach($services as $service){
            $service_terminals = Terminal::getTerminalsByServiceId($service->service_id);
            foreach($service_terminals as $terminal){
                array_push($terminals, $terminal);
            }
        }
        return $terminals;
    }

    public static function getTerminalsByBusinessId($business_id){
        $branches = Branch::where('business_id', '=', $business_id)->get();
        $terminals = [];
        foreach($branches as $branch){
            $branch_terminals = Terminal::getTerminalsByBranchId($branch->branch_id);
            foreach($branch_terminals as $terminal){
                array_push($terminals, $terminal);
            }
        }
        return $terminals;
    }

    public static function getAssignedTerminalWithUsers($terminals){
        foreach($terminals as $index => $terminal){
            $terminals[$index]['users'] = TerminalUser::getAssignedUsers($terminal['terminal_id']);
        }
        return $terminals;
    }

    public static function deleteTerminal($terminal_id){
        TerminalUser::where('terminal_id', '=', $terminal_id)->delete();
        Terminal::where('terminal_id', '=', $terminal_id)->delete();
        Helper::dbLogger('Terminal', 'terminal', 'delete', 'deleteTerminal', User::email(Helper::userId()), 'terminal_id:' . $terminal_id);
    }

    public static function createBusinessNewTerminal($business_id, $name){
        $first_branch = Branch::where('business_id', '=', $business_id)->first();
        $first_service = Service::where('branch_id', '=', $first_branch->branch_id)->first();
        Terminal::createTerminal($first_service->service_id, $name);
    }

    // Added by PAG
    // 12032015 Updated by ARA for multiple services implementation
    private static function generateBoxRank($service_id) {
        $box_rank = array();
        $business_id = Business::getBusinessIdByServiceId($service_id);
        $res = Terminal::join('service', 'terminal.service_id', '=', 'service.service_id')
            ->join('branch', 'service.branch_id', '=', 'branch.branch_id')
            ->join('business', 'branch.business_id', '=', 'business.business_id')
            ->where('business.business_id', '=', $business_id)
            ->select(array('box_rank'))->get();
        foreach ($res as $count => $data) {
            $box_rank[] = $data->box_rank;
        }

        for($rank = 1; in_array($rank, $box_rank); $rank++); return $rank;
    }

    public static function boxRank($terminal_id) {
        return $terminal_id ? Terminal::where('terminal_id', '=', $terminal_id)->select(array('box_rank'))->first()->box_rank : 0;
    }

    public static function setName($terminal_id, $name) {
        Terminal::where('terminal_id', '=', $terminal_id)->update(array('name' => $name));
    }

  public static function deleteTerminalsByServiceId($service_id) {
    Terminal::where('service_id', '=', $service_id)->delete();
      Helper::dbLogger('Terminal', 'terminal', 'delete', 'deleteTerminalsByServiceId', User::email(Helper::userId()), 'service_id:' . $service_id);
  }

    public static function setColor($hex_color, $terminal_id) {
        Terminal::where('terminal_id', '=', $terminal_id)->update(array('color' => $hex_color));
    }

    public static function getColorByTerminalId($terminal_id) {
        return Terminal::where('terminal_id', '=', $terminal_id)->select(array('color'))->first()->color;
    }

}