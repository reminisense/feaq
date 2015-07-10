<?php
/**
 * Created by IntelliJ IDEA.
 * User: polljii
 * Date: 1/5/15
 * Time: 6:34 PM
 */

class FeatherqConstants {

    //ARA declare all constants
    public static function init(){
        FeatherqConstants::roles();
        FeatherqConstants::frontlineSms();
        FeatherqConstants::android();
    }

    // Define global variables for users roles
    public static function roles()
    {
        define('REMINISENSE', 1);
        define('BUSINESS_OWNER', 2);
        define('QUEUE_ADMIN', 3);
        define('TERMINAL_ADMIN', 4);
        define('END_USER', 5);
        define('IT_ADMIN', 6);
    }

    //Define frontlinesms constants
    public static function frontlineSms()
    {
        //Frontline SMS constants
        define('FRONTLINE_SMS_SECRET', 'Reminisense!1');

        //local url constants ARA
        //define('FRONTLINE_SMS_HOST', 'http://192.168.137.115:8130');
        //define('FRONTLINE_SMS_URL', FRONTLINE_SMS_HOST . '/api/1/webconnection/1');

        //dev environment constants
        define('FRONTLINE_SMS_HOST', 'http://dev-env.featherq.com');
        define('FRONTLINE_SMS_URL', 'https://cloud.frontlinesms.com/api/1/webconnection/3225');
    }

    //Define Android constants
    public static function android(){
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AIzaSyCj0EfjXkZe-USRLOlTXxywayUXSIYg1wA' );
    }

}