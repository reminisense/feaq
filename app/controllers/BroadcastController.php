<?php
/**
 *
 * Should contain functions related to the broadcast page
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 5:11 PM
 */

class BroadcastController extends BaseController{

    public function getBranch($branch_id = 0)
    {
        if (Branch::name($branch_id) == 'Main') {
            $business_name = Business::name(Branch::businessId($branch_id));
        }
        else {
            $business_name = Branch::name($branch_id) . ' > ' . Business::name(Branch::businessId($branch_id));
        }
        return View::make('broadcast')
          ->with('business_name', $business_name);
    }

}