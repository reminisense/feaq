<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:21 PM
 */

class Branch extends Eloquent{

    protected $table = 'branch';
    protected $primaryKey = 'branch_id';
    public $timestamps = false;

    public static function businessId($branch_id){
        return Branch::where('branch_id', '=', $branch_id)->select(array('business_id'))->first()->business_id;
    }

    public static function name($branch_id){
        return Branch::where('branch_id', '=', $branch_id)->select(array('name'))->first()->name;
    }

    /*
     * @author: CSD
     * @description: create new branch on business setup
     * @return branch_id
     */
    public static function createBusinessBranch($business_id, $business_name){
        $branch = new Branch();
        $branch->name = $business_name . " Branch";
        $branch->business_id = $business_id;
        $branch->save();

        return $branch->branch_id;
    }

    /*
     * @author: CSD
     * @description: fetch all branches by business id
     * @return branches array by business id
     */
    public static function getBranchesByBusinessId($business_id){
        return Branch::where('business_id', '=', $business_id)->get();
    }
}