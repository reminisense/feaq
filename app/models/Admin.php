<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/21/15
 * Time: 4:11 PM
 */

class Admin extends Eloquent{

    public static function csvUrl(){
        return base_path('app/constants/FeatherqAdmins.csv');
    }

    public static function addAdmin($email){
        try{
            $emails = Admin::getAdmins();
            if(!in_array($email, $emails)){
                $emails[] = $email;
                $file = fopen(Admin::csvUrl(), 'w');
                fputcsv($file, $emails, ',');
                fclose($file);
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public static function removeAdmin($email){
        try{
            $emails = Admin::getAdmins();
            if (in_array($email, $emails)){
                unset($emails[array_search($email,$emails)]);
                $file = fopen(Admin::csvUrl(), 'w');
                fputcsv($file, $emails, ',');
                fclose($file);
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public static function getAdmins(){
        try{
            $file = fopen(Admin::csvUrl(), 'r');
            $emails = fgetcsv($file);
            fclose($file);
            return $emails;
        }catch(Exception $e){
            return [];
        }
    }

    public static function isAdmin($user_id = null){
        try{
            $user_id = $user_id != null ? $user_id : Helper::userId();
            $emails = Admin::getAdmins();
            return in_array(User::email($user_id), $emails);
        }catch(Exception $e){
            return false;
        }
    }

}