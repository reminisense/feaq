<?php

use utils\RandomStringGenerator;

/**
 * ARA - Helper class
 *
 * functions that can be used across different models/controllers
 * should be placed in this class
 *
 * Created by PhpStorm.
 * User: USER
 * Date: 1/22/15
 * Time: 2:37 PM
 */

class Helper extends Eloquent {

  public static function VerifyFB($accessToken) {
    // Call Facebook and let them verify if the information sent by the user
    // is the same with the ones in their database.
    // This will save us from the exploit of a post request with bogus details
    $fb = new Facebook\Facebook(array(
      'app_id' => '1622215494691199',
      'app_secret' => '93b2a59f31795425dd57dc961818824f',
      'default_graph_version' => 'v2.4',
    ));
    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->get('/me', $accessToken); // Use the access token retrieved by JS login
      return $response;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      //return json_encode(array('message' => $e->getMessage()));
      Auth::logout();
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        //return json_encode(array('message' => $e->getMessage()));
        Auth::logout();
    }
  }

    /**
     * Generates random 4-character raw_code.
     */
    public static function generateRawCode()
    {
        // Set token length.
        $tokenLength = 4;

        // Call method to generate random string.
        $raw_id = \RandomStringGenerator::generate($tokenLength);

        return $raw_id;
    }
    
    /**
     * Returns true if raw_code exists in database.
     * @param $rawCode
     * @return bool
     */
    public static function isRawCodeExists($rawCode) {
        return Helper::firstFromTable('business', 'raw_code', $rawCode, '=');
        //return !empty($ret);
    }

    /**
     * gets the user id of the current user
     * @return mixed
     */
    public static function userId(){
        if(Auth::check()){
            return Auth::user()->user_id;
        }else{
            return 0;
        }
    }

    /**
     * gets the role id of the current session's user
     * @return mixed
     */
    public static function currentUserRoleId(){
        return DB::table('user_role')->where('user_id', '=', Helper::userId())->first()->role_id;
    }

    /**
     * checks if the role of the current user is in the given array
     * @return mixed
     */
    public static function currentUserIsEither($roles = array()){
        return in_array(Helper::currentUserRoleId(), $roles);
    }

    public static function parseTime($time){
        $arr = explode(' ', $time);
        $hourmin = explode(':', $arr[0]);

        return [
            'hour' => trim($hourmin[0]),
            'min'  => trim($hourmin[1]),
            'ampm' => trim($arr[1]),
        ];
    }

    public static function mergeTime($hour, $min, $ampm){
        return Helper::doubleZero($hour).':'.Helper::doubleZero($min).' '.$ampm;
    }

    public static function doubleZero($number){
        return $number == 0 ? '00' : $number;
    }

    public static function millisecondsToHMSFormat($ms){
        $second = $ms % 60;
        $ms = floor($ms / 60);

        $minute = $ms % 60;
        $ms = floor($ms / 60);

        $hour = $ms % 24;
        return Helper::formatTime($second, $minute, $hour);
    }

    public static function formatTime($second, $minute, $hour){
        $time_string = '';
        $time_string .= $hour > 0 ? $hour . ' hour(s) ' : '';
        $time_string .= $minute > 0 ? $minute . ' minute(s) ' : '';
        $time_string .= $second > 0 ? $second . ' second(s) ' : '';
        return $time_string;
    }

    public static function customSort($property, $var1, $var2){
        return $var1[$property] - $var2[$property];
    }

    public static function customSortRev($property, $var1, $var2){
        return $var2[$property] - $var1[$property];
    }

    public static function firstFromTable($table, $field, $value, $operator = '='){
        return DB::table($table)->where($field, $operator, $value)->first();
    }

    /**
     * requires an array of arrays
     * ex. 'field' => array('conditional_operator', 'value')
     * @param $conditions
     * @return mixed
     */
    public static function getMultipleQueries($table, $conditions){
        $query = DB::table($table);
        foreach($conditions as $field => $value){
            $field = strpos($field, '.') > 0 ? substr($field, 0, strpos($field, '.')) : $field;
            if(is_array($value)){
                $query->where($field, $value[0], $value[1]);
            }else{
                $query->where($field, '=', $value);
            }
        }
        return $query->get();
    }


    public static function getIP()
    {
        return $_SERVER["REMOTE_ADDR"];

        // populate a local variable to avoid extra function calls.
        // NOTE: use of getenv is not as common as use of $_SERVER.
        //       because of this use of $_SERVER is recommended, but
        //       for consistency, I'll use getenv below
        $tmp = getenv("HTTP_CLIENT_IP");
        // you DON'T want the HTTP_CLIENT_ID to equal unknown. That said, I don't
        // believe it ever will (same for all below)
        if ( $tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        $tmp = getenv("HTTP_X_FORWARDED_FOR");
        if( $tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        // no sense in testing SERVER after this.
        // $_SERVER[ 'REMOTE_ADDR' ] == gentenv( 'REMOTE_ADDR' );
        $tmp = getenv("REMOTE_ADDR");
        if($tmp && !strcasecmp($tmp, "unknown"))
            return $tmp;

        return("unknown");
    }

    /**
     * @param $birthdate must be int ex. strtotime(1/1/1990)
     */
    public static function getAge($birthdate){
        return floor( (time() - $birthdate) / 31556926);
    }

    public static function getTimezoneList()
    {
        //$timezones = DateTimeZone::listIdentifiers(DateTimeZone::UTC);
        // got this from: http://stackoverflow.com/a/6369355
        // human-readable, no need to processing
        // just add other timezones as required...
        $timezones = array(
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Europe/Moscow' => "(GMT+03:00) Moscow",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Manila' => "(GMT+08:00) Manila",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );
        return $timezones;
    }

    /**
     * gets the date and timezone of business and converts it to user/browser timezone
     * @param $date
     * @param $business_timezone
     * @param $user_timezone
     * @return string
     */
    public static function changeBusinessTimeTimezone($date, $business_timezone, $browser_timezone){
        if(is_numeric($browser_timezone)) $browser_timezone = Helper::timezoneOffsetToName($browser_timezone);
        $datetime = new DateTime($date, new DateTimeZone($business_timezone));
        $datetime->setTimezone(new DateTimeZone($browser_timezone));
        return $datetime->format('g:i A');
    }

    /**
     * gets timezone offset and converts it to php timezone string
     * @param $offset
     * @return bool
     */
    public static function timezoneOffsetToName($offset){
        $abbrarray = timezone_abbreviations_list();
        foreach ($abbrarray as $abbr) {
            foreach ($abbr as $city) {
                if ($city['offset'] == $offset) {
                    return $city['timezone_id'];
                }
            }
        }
        return false;
    }

    public static function timezoneOffsetToNameArray($offset){
        $timezones = [];
        $abbrarray = timezone_abbreviations_list();
        foreach ($abbrarray as $abbr) {
            foreach ($abbr as $city) {
                if ($city['offset'] == $offset) {
                    $timezones[] = $city['timezone_id'];
                }
            }
        }
        return $timezones;
    }

  public static function isBusinessOwner($business_id, $user_id) {
    return $business_id == UserBusiness::getBusinessIdByOwner($user_id);
  }

  public static function isPartOfBusiness($business_id, $user_id) {
    $res = TerminalUser::getTerminalAssignement($user_id);
    if (isset($res)) {
      foreach ($res as $count => $data) {
        if ($business_id == Business::getBusinessIdByTerminalId($data['terminal_id'])) {
          return TRUE;
        }
      }
    }
    return FALSE;
  }

  public static function isNotAnOwner($user_id) {
    return !UserBusiness::getBusinessIdByOwner($user_id);
  }

}