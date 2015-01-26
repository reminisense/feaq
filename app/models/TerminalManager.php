<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/23/15
 * Time: 4:32 PM
 */

class TerminalManager extends Eloquent{

    protected $table = 'terminal_manager';
    protected $primaryKey = 'login_id';
    public $timestamps = false;

    public static function hookedTerminal($user_id, $terminal_id = 0) {
        if ($terminal_id) {
            if (DB::table('terminal_manager')->select(DB::raw('COUNT(*) AS counter'))->where('terminal_id', '=', $terminal_id)->first()->counter) {
                return DB::table('terminal_manager')->orderBy('login_id', 'desc')->select('in_out')->where('terminal_id', '=', $terminal_id)->first()->in_out;
            }
        }
        else {
            return DB::table('terminal_manager')->orderBy('login_id', 'desc')->select('terminal_id')->where('user_id', '=', $user_id)->first()->terminal_id;
        }
    }

    public static function getLatestLoginIdOfTerminal($terminal_id) {
        return DB::table('terminal_manager')->orderBy('login_id', 'desc')->select('login_id')->where('terminal_id', '=', $terminal_id)->first()->login_id;
    }

    public static function getTerminalManagerLoginId($user_id){
        $row = DB::table('terminal_manager')->orderBy('login_id', 'desc')->where('user_id', '=', $user_id)->first();
        return $row ? $row->login_id : null;
    }

    public static function checkLoginIdIsUser($user_id, $login_id){
        $row = DB::table('terminal_manager')->where('user_id', '=', $user_id)->where('login_id', '=', $login_id)->get();
        return $row ? true: false;
    }

}