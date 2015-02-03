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

    /*
     * @author: CSD
     * @description: create terminal on business creation/setup
     * @return none
     */
    public static function createBranchServiceTerminal($branch_id, $service_id, $num){
        for($i = 1; $i <= $num; $i++){
            $terminal = new Terminal();
            $terminal->name = "Terminal " . $i;
            $terminal->service_id = $service_id;
            $terminal->status = 1;

            $terminal->save();
        }
    }

    /*
     * @author: CSD
     * @description: fetch terminals by service id
     * @return: terminal array by service id
     */
    public static function getTerminalsByServiceId($service_id){
        return Terminal::where('service_id', '=', $service_id)->get();
    }

    public static function name($terminal_id){
        return Terminal::find($terminal_id)->name;
    }

    public static function serviceId($terminal_id){
        return Terminal::find($terminal_id)->service_id;
    }

}