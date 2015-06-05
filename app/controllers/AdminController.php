<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 5/21/15
 * Time: 3:37 PM
 */

class AdminController extends BaseController{

    public function getDashboard(){
        if(Admin::isAdmin()){
            return View::make('admin.admin-dashboard');
        }else{
            return Redirect::to('/');
        }
    }

    //temporary function to display user tracking data
    public function getStats(){
        if(Admin::isAdmin()){
            return View::make('analytics.user_analytics');
        }else{
            return Redirect::to('/');
        }
    }

    public function getBusiness(){
        if(Admin::isAdmin()){
            return View::make('admin.business-dashboard');
        }else{
            return Redirect::to('/');
        }
    }

    public function getNumbers(){
        if(Admin::isAdmin()){
            return View::make('analytics.user_numbers');
        }else{
            return Redirect::to('/');
        }
    }

    public function getShowgraph($start_date, $end_date, $mode, $value){
        if(Admin::isAdmin()){
            return View::make('admin.business-graph')->with('start_date', $start_date)
                ->with('end_date', $end_date)->with('mode', $mode)->with('value', $value);
        }else{
            return Redirect::to('/');
        }
    }


    public function getAddAdmin($email){
        if(Admin::isAdmin()){
            Admin::addAdmin($email);
            return json_encode(['success' => true]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getDeleteAdmin($email){
        if(Admin::isAdmin()){
            Admin::removeAdmin($email);
            return json_encode(['success' => true]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getAdmins(){
        if(Admin::isAdmin()){
            return json_encode(['success' => true, 'admins' => Admin::getAdmins()]);
        }else{
            return json_encode(['error' => 'Access Denied.']);
        }
    }

    public function getBusinessnumbers($start_date, $end_date){

        $temp_date = $end_date + 86400;

        $businesses = Business::countBusinessByRange($start_date, $temp_date);
        $users = User::countUsersByRange($start_date, $temp_date);
        $issued_numbers = Analytics::countBusinessNumbers($start_date, $end_date, 0);
        $called_numbers = Analytics::countBusinessNumbers($start_date, $end_date, 1);
        $served_numbers = Analytics::countBusinessNumbers($start_date, $end_date, 2);
        $dropped_numbers = Analytics::countBusinessNumbers($start_date, $end_date, 3);

        return json_encode(['success' => 1, 'businesses' => $businesses, 'users' => $users,
            'issued_numbers' => $issued_numbers, 'called_numbers' => $called_numbers, 'served_numbers' => $served_numbers, 'dropped_numbers' => $dropped_numbers ]);
    }

    public function getAllbusinesses(){
        $businesses = Business::getAllBusinessNames();
        return json_encode(['success' => 1, 'businesses' => $businesses]);
    }

    public function getNumbersissued($start_date, $end_date, $mode, $value){

        $temp_start_date = $start_date;
        $temp_end_date = $end_date + 86400;

        if($mode == "business"){

            $issued_numbers = [];
            $called_numbers = [];
            $served_numbers = [];
            $dropped_numbers = [];
            $business= Business::getBusinessIdByName($value);

            while($temp_start_date  < $temp_end_date){

                $next_day = $temp_start_date + 86400;

                for($i = 0; $i < count($business); $i++ ) {

                    $issued_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, $next_day, 0);
                    $called_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, $next_day, 1);
                    $served_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, $next_day, 2);
                    $dropped_count = Analytics::countNumbersByBusiness($business[$i]->business_id, $temp_start_date, $next_day, 3);

                    array_push($issued_numbers, $issued_count);
                    array_push($called_numbers, $called_count);
                    array_push($served_numbers, $served_count);
                    array_push($dropped_numbers, $dropped_count);
                }
                $temp_start_date = $next_day;
            }

            return json_encode(['success' => 1, 'issued_numbers' => $issued_numbers, 'called_numbers' => $called_numbers,
                'served_numbers' => $served_numbers, 'dropped_numbers' => $dropped_numbers]);

        }else if($mode == "industry"){

            $issued_numbers = [];
            $called_numbers = [];
            $served_numbers = [];
            $dropped_numbers = [];

            while($temp_start_date < $temp_end_date){

                $next_day = $temp_start_date + 86400;

                $issued_count = Analytics::countNumbersByIndustry($value,$temp_start_date,$next_day,0);
                $called_count = Analytics::countNumbersByIndustry($value,$temp_start_date,$next_day,1);
                $served_count = Analytics::countNumbersByIndustry($value,$temp_start_date,$next_day,2);
                $dropped_count = Analytics::countNumbersByIndustry($value,$temp_start_date,$next_day,3);

                array_push($issued_numbers,  $issued_count);
                array_push($called_numbers,  $called_count);
                array_push($served_numbers,  $served_count);
                array_push($dropped_numbers,  $dropped_count);

                $temp_start_date = $next_day;
            }

            return json_encode(['success' => 1, 'issued_numbers' => $issued_numbers, 'called_numbers' => $called_numbers,
                'served_numbers' => $served_numbers, 'dropped_numbers' => $dropped_numbers]);

        }else if($mode == "country"){

            $issued_numbers = [];
            $called_numbers = [];
            $served_numbers = [];
            $dropped_numbers = [];

            while($temp_start_date < $temp_end_date){

                $next_day = $temp_start_date + 86400;

                $issued_count = Analytics::countNumbersByCountry($value,$temp_start_date,$next_day,0);
                $called_count = Analytics::countNumbersByCountry($value,$temp_start_date,$next_day,1);
                $served_count = Analytics::countNumbersByCountry($value,$temp_start_date,$next_day,2);
                $dropped_count = Analytics::countNumbersByCountry($value,$temp_start_date,$next_day,3);

                array_push($issued_numbers,  $issued_count);
                array_push($called_numbers,  $called_count);
                array_push($served_numbers,  $served_count);
                array_push($dropped_numbers,  $dropped_count);

                $temp_start_date = $next_day;
            }

            return json_encode(['success' => 1, 'issued_numbers' => $issued_numbers, 'called_numbers' => $called_numbers,
                'served_numbers' => $served_numbers, 'dropped_numbers' => $dropped_numbers]);
        }
    }

}