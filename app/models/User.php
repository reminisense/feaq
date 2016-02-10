<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    // LOGIN FIX
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public static function saveFBDetails($data)
    {
        if (!User::checkFBUser($data['fb_id']))
        {
            User::insert($data);
            Notifier::sendSignupEmail($data['email'], $data['first_name'] . ' ' . $data['last_name']);
        }
    }

    public static function updateContactCountry($fb_id, $contact, $country)
    {
        return User::where('fb_id', '=', $fb_id)
            ->update(array(
                'phone' => $contact,
                'country' => $country,
                'verified' => '1'
            ));
    }

	public static function checkFBUser($fb_id)
    {
        return User::where('fb_id', '=', $fb_id)->exists();

    }

    public static function getUserIdByFbId($fb_id)
    {
        return User::where('fb_id', '=', $fb_id)->select(array('user_id'))->first()->user_id;
    }

    public static function searchByEmail($email){
        $user =  User::where('verified', '=', 1)
            ->where('email', '=', $email )
            ->select('user_id', 'first_name', 'last_name', 'email')
            ->first();
        return $user ? $user->toArray() : null;
    }

    public static function searchByKeyword($keyword){
        $users = User::where('user_id', '=', $keyword)
            ->orwhere('first_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere(DB::raw('CONCAT_WS(" ", `first_name`, `last_name`)'), 'LIKE', $keyword)
            ->select('user_id', 'first_name', 'last_name', 'email')
            ->get();
        return $users;
    }

    /**
     * @author Ruffy Heredia
     * @description Get User by Facebook ID
     */
    public static function searchByFacebookId($fb_id) {
        $user = User::where('verified', '=', 1)
            ->where('fb_id', '=', $fb_id)
            ->select('user_id', 'first_name', 'last_name', 'email')
            ->first();
        return $user ? $user->toArray() : null;
    }

    /**
     * @author Ruffy Heredia
     * @param $fb_id
     * @return GCM token of user
     */
    public static function getGcmByFacebookId($fb_id) {
        $user = User::where('fb_id', '=', $fb_id)
            ->select('gcm_token')
            ->first();
        return $user ? $user->toArray() : null;
    }

    /* @author: CSD
     * @description: get details needed for broadcast contact auto populate on modal form
     * @date: 06/02/2015
     */
    public static function getUserByUserId($user_id){
        $user = User::where('user_id', '=', $user_id)->get()->first();
        $broadcastuser['user_id'] = $user->user_id;
        $broadcastuser['email'] = $user->email;
        $broadcastuser['first_name'] = $user->first_name;
        $broadcastuser['last_name'] = $user->last_name;
        $broadcastuser['phone'] = $user->phone;

        return $broadcastuser;
    }

    /**
     * @author Carl Dalid
     * @description Update GCM Token
     */
    public static function updateGCMToken($fb_id, $gcm){
        return User::where('fb_id', '=', $fb_id)->update(array('gcm_token' => $gcm));
    }

    //ARA Used for user demographics tracking
    public static function first_name($user_id){
        return User::where('user_id', '=', $user_id)->first()->first_name;
    }

    public static function last_name($user_id){
        return User::where('user_id', '=', $user_id)->first()->last_name;
    }

    public static function full_name($user_id){
        return User::first_name($user_id) . ' ' . User::last_name($user_id);
    }

    public static function phone($user_id){
        return User::where('user_id', '=', $user_id)->first()->phone;
    }

    public static function email($user_id){
        return User::where('user_id', '=', $user_id)->first()->email;
    }

    public static function local_address($user_id){
        return User::where('user_id', '=', $user_id)->first()->local_address;
    }

    public static function gender($user_id){
        return User::where('user_id', '=', $user_id)->first()->gender;
    }

    public static function nationality($user_id){
        return User::where('user_id', '=', $user_id)->first()->nationality;
    }

    public static function civil_status($user_id){
        return User::where('user_id', '=', $user_id)->first()->civil_status;
    }

    public static function birthdate($user_id){
        return User::where('user_id', '=', $user_id)->first()->birthdate;
    }

    public static function getStatusByUserId($user_id){
        return User::where('user_id', '=', $user_id)->first()->status;
    }

    public static function age($user_id){
        $birthdate = User::birthdate($user_id);
        if($birthdate){
            return Helper::getAge($birthdate);
        }else{
            return null;
        }
    }

    public static function gcmToken($user_id){
        return User::where('user_id', '=', $user_id)->first()->gcm_token;
    }


    public static function getUsersByRange($start_date, $end_date)
    {
        $temp_start_date = date("Y/m/d", $start_date);
        $temp_end_date = date("Y/m/d", $end_date);
        return User::where('registration_date', '>=', $temp_start_date)->where('registration_date', '<', $temp_end_date)->get();
    }

    public static function getUserHistory($user_id, $limit, $offset){
        $results = User::where('user.user_id', '=', $user_id)
            ->join('priority_queue', 'priority_queue.email', '=', 'user.email')
            ->join('queue_analytics', 'queue_analytics.transaction_number', '=', 'priority_queue.transaction_number')
            ->join('business', 'business.business_id', '=', 'queue_analytics.business_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->join('user_rating', 'user_rating.transaction_number', '=', 'priority_queue.transaction_number')
            ->where('user_rating.rated_by', '=', 'user')
            ->selectRaw('
                queue_analytics.transaction_number,
                queue_analytics.date as date,
                priority_queue.priority_number,
                priority_queue.email,
                business.business_id as business_id,
                business.name as business_name,
                business.local_address as business_address,
                terminal_transaction.time_completed as time_completed,
                terminal_transaction.time_queued as time_queued,
                user_rating.rating as rating,
                MAX(queue_analytics.action) as status
            ')
            ->orderBy('queue_analytics.transaction_number', 'desc')
            ->groupBy('queue_analytics.transaction_number')
            ->skip($offset)
            ->take($limit)
            ->get()
            ->toArray();

        return $results;
    }

    public static function getUserBusinessHistory($user_id, $transaction_number){

        $result = User::where('user.user_id', '=', $user_id)
            ->join('priority_queue', 'priority_queue.email', '=', 'user.email')
            ->join('queue_analytics', 'queue_analytics.transaction_number', '=', 'priority_queue.transaction_number')
            ->join('business', 'business.business_id', '=', 'queue_analytics.business_id')
            ->join('terminal_transaction', 'terminal_transaction.transaction_number', '=', 'priority_queue.transaction_number')
            ->join('user_rating', 'user_rating.transaction_number', '=', 'priority_queue.transaction_number')
            ->where('priority_queue.transaction_number','=',$transaction_number)
            ->where('user_rating.rated_by', '=', 'user')
            ->selectRaw('
                queue_analytics.transaction_number,
                queue_analytics.date as date,
                priority_queue.priority_number,
                priority_queue.email,
                business.business_id as business_id,
                business.name as business_name,
                business.local_address as business_address,
                business.longitude as longitude,
                business.latitude as latitude,
                terminal_transaction.time_completed as time_completed,
                terminal_transaction.time_queued as time_queued,
                terminal_transaction.time_queued as time_called,
                user_rating.rating as rating,
                MAX(queue_analytics.action) as status
            ')
            ->first();

        return $result;
    }

    public static function getUserIdByEmail($email) {
        return User::where('email', '=', $email)->select(array('user_id'))->first()->user_id;
    }
}