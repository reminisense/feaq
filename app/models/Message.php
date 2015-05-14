<?php

class Message extends Eloquent {
    protected $table = 'message';
    protected $primaryKey = 'message_id';
    public $timestamps = false;

  public static function checkThreadByKey($thread_key) {
    return Message::where('thread_key', '=', $thread_key)->exists();
  }

  public static function createThread($val = array()) {
    Message::insert($val);
  }
  public static function updateThread($val = array(), $thread_key) {
    Message::where('thread_key', '=', $thread_key)->update($val);
  }

  public static function getPhoneByKey($thread_key) {
    return Message::where('thread_key', '=', $thread_key)->select(array('phone'))->first()->phone;
  }

}