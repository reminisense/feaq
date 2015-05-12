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
		}
	}

	public static function checkFBUser($fb_id)
    {
		return User::where('fb_id', '=', $fb_id)->exists();

	}

	public static function getUserIdByFbId($fb_id)
	{
		return User::where('fb_id', '=', $fb_id)->select(array('user_id'))->first()->user_id;
	}

//    removed due to new implementation of assigning users
//    public static function getAllUsers(){
//        return User::where('verified', '=', 1)
//            ->where('first_name', '!=', '' )
//            ->where('last_name', '!=', '' )
//            ->select('user_id', 'first_name', 'last_name')
//            ->get()
//            ->toArray();
//    }

    public static function searchByEmail($email){
        $user =  User::where('verified', '=', 1)
            ->where('email', '=', $email )
            ->select('user_id', 'first_name', 'last_name', 'email')
            ->first();
        return $user ? $user->toArray() : null;
    }


    //ARA Used for user demographics tracking
    public static function email($user_id){
        return User::where('user_id', '=', $user_id)->first()->email;
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

    public static function age($user_id){
        $birthdate = User::birthdate($user_id);
        if($birthdate){
            return Helper::getAge($birthdate);
        }else{
            return null;
        }
    }
}
