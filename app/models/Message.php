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

  public static function getThreadKeyByMessageId($message_id) {
    return Message::where('message_id', '=', $message_id)->select(array('thread_key'))->first()->thread_key;
  }

  public static function getMessagesByBusinessId($business_id) {
    return Message::where('business_id', '=', $business_id)->get();
  }

}