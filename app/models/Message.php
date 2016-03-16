<?php

class Message extends Eloquent {
    protected $table = 'message';
    protected $primaryKey = 'message_id';
    public $timestamps = false;

    public static function checkThreadByKey($thread_key) {
        return Message::where('thread_key', '=', $thread_key)->exists();
    }

    public static function createThread($val = array()) {
        $message_id = Message::insertGetId($val);
        //Helper::dbLogger('Message', 'message', 'insert', 'createThread', User::email(Helper::userId()), 'message_id:' . $message_id);
    }
    public static function updateThread($val = array(), $thread_key) {
        Message::where('thread_key', '=', $thread_key)->update($val);
        //Helper::dbLogger('Message', 'message', 'update', 'updateThread', User::email(Helper::userId()), 'thread_key:' . $thread_key);
    }

    public static function getPhoneByKey($thread_key) {
        return Message::where('thread_key', '=', $thread_key)->select(array('phone'))->first()->phone;
    }

    public static function getBusinessIdByMessageId($message_id) {
        return Message::where('message_id', '=', $message_id)->select(array('business_id'))->first()->business_id;
    }

    public static function getPhoneByMessageId($message_id) {
        return Message::where('message_id', '=', $message_id)->select(array('phone'))->first()->phone;
    }

    public static function getBusinessIdByThreadKey($thread_key) {
        return Message::where('thread_key', '=', $thread_key)->select(array('business_id'))->first()->business_id;
    }

    public static function getMessageIdByThreadKey($thread_key) {
        return Message::where('thread_key', '=', $thread_key)->select(array('message_id'))->first()->message_id;
    }

    public static function getThreadKeyByMessageId($message_id) {
        return Message::where('message_id', '=', $message_id)->select(array('thread_key'))->first()->thread_key;
    }

    public static function getMessagesByBusinessId($business_id) {
        return Message::where('business_id', '=', $business_id)->get();
    }

    public static function getMessagesByThreadKey($thread_key) {
        return Message::where('thread_key', '=', $thread_key)->get();
    }

    public static function getThreadKeyByBusinessIdAndEmail($business_id, $email) {
        return Message::where('business_id', '=', $business_id)->where('email', '=', $email)->select(array('thread_key'))->first()->thread_key;
    }

    public static function getMessagesByEmail($email){
        return Message::where('email', '=', $email)->get();
    }

    public static function threadKeyGenerator($business_id, $email) {
        return md5($business_id . 'fq' . $email);
    }

    public static function getThreadKeysByEmail($email) {
        return Message::where('email', '=', $email)->select(array('thread_key'))->get();
    }

    public static function sendInitialMessage($business_id, $email, $name = null, $phone = null){
        $thread_key = Helper::threadKeyGenerator($business_id, $email);
        $business_name = Business::name($business_id);
        $file = public_path() . '/json/messages/' . $thread_key . '.json';
        $data = array();
        if (!Message::checkThreadByKey($thread_key)) {
            Message::createThread(array(
                'thread_key' => $thread_key,
                'business_id' => $business_id,
                'email' => $email,
                'contactname' => $name ? $name : '',
                'phone' => $phone ? $phone : ''
            ));
        }else{
            if(file_exists($file)) {
                $data = json_decode(file_get_contents($file));
            }
        }
        $data[] = [
            'timestamp' => time(),
            'contmessage' => 'Thank you for lining up at ' . $business_name .'!',
            'attachment' => '',
            'sender' => 'business',
        ];
        file_put_contents($file, json_encode($data));
    }
}