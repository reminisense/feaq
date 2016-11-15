<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/15/2016
 * Time: 1:08 PM
 */


class FreeApiController extends BaseController{

    public $freeApi;
    public function __construct(){
        $this->freeApi = new FreeApi();
    }

    /*******************************************************************************************************************
     * Search page webservices here
     */

    /**
     * get Categories
     * @return string
     */
    public function getCategories(){
        return json_encode(['categories' => Business::getAvailableIndustries()]);
    }

    /**
     * get businesses based on search
     * @return mixed
     */
    public function postSearchBusiness(){
        return $this->freeApi->getBusinessSearch(Input::all());
    }

    /*******************************************************************************************************************
     * Login page webservices here
     */

    /**
     * Login to featherq account
     */
    public function postLogin(){}

    /*******************************************************************************************************************
     * Register page webservices here
     */

    /**
     * Register new user and create new business
     */
    public function postRegister(){}

    /*******************************************************************************************************************
     * Dashboard/Settings page webservices here
     */

    /**
     * get business details by business id
     * @param $business_id
     */
    public function getBusiness($business_id){}

    /**
     * edit and save business details
     * @param $business_id
     */
    public function postSaveDetails($business_id){}

    /**
     * Resets the password of the user
     * @param $user_id
     */
    public function postResetPassword($user_id){}

    /**
     * Change password of the user
     * @param $post[user_id]
     * @param $post[old_password]
     * @param $post[new_password]
     */
    public function postChangePassword(){}

    /*******************************************************************************************************************
     * Issue number page webservices here
     */

    /**
     * get the last number given in the service
     * @param $service_id
     */
    public function getLastNumber($service_id){}

    /**
     * issue a new number for the service
     * @param $post[service_id]
     * @param $post[priority_number]
     */
    public function postIssueNumber(){}

    /**
     * gets the estimated time to call the number specified
     * @param $number
     */
    public function getEstimatedTime($number){}

    /*******************************************************************************************************************
     * Call number page webservices here
     */

    /**
     * get all numbers of a service
     * @param $service_id
     */
    public function getAllNumbers($service_id){}

    /**
     * calls the number specified
     * @param $post[transaction_number]
     */
    public function postCallNumber(){}

    /**
     * serves the number specified
     * @param $post[transaction_number]
     */
    public function postServeNumber(){}

    /**
     * drops the number specified
     * @param $post[transaction_number]
     */
    public function postDropNumber(){}

    /*******************************************************************************************************************
     * Customer broadcast page webservices here
     */

    /**
     * get broadcast screen and details for business view
     * @param $business_id
     */
    public function getBusinessBroadcast($business_id){}

    /*******************************************************************************************************************
     * Business broadcast page webservices here
     */

    /**
     * get broadcast screen and details for customer view
     * @param $business_id
     */
    public function getCustomerBroadcast($business_id){}

}