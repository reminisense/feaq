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

    public static function name($terminal_id){
        return Terminal::find($terminal_id)->name;
    }

    public static function serviceId($terminal_id){
        return Terminal::find($terminal_id)->service_id;
    }

    public static function getTerminalsByServiceId($service_id){
        return Terminal::where('service_id', '=', $service_id)->get()->toArray();
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
            $terminals[$index]['users'] = TerminalManager::getAssignedUsers($terminal['terminal_id']);
        }
        return $terminals;
    }

}