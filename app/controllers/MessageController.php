<?php

class MessageController extends BaseController {

  public function postSendtoBusiness() {
    $business_id = Input::get('business_id');
    $email = Input::get('contemail');
    $name = Input::get('contname');
    $timestamp = time();
    $thread_key = $this->threadKeyGenerator($business_id, $email);

    if (!Message::checkThreadByKey($thread_key)) {
        $phones[] = Input::get('contmobile');
      Message::createThread(array(
        'contactname' => $name,
        'business_id' => $business_id,
        'email' => $email,
        'phone' => serialize($phones),
        'thread_key' => $thread_key,
      ));
      $data = json_encode(array(array(
        'timestamp' => $timestamp,
        'contmessage' => Input::get('contmessage'),
        'sender' => 'user',
      )));
      file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
    }
    else {
      $phone = Input::get('contmobile');
      $phones = unserialize(Message::getPhoneByKey($thread_key));
      if (!is_array($phones)) $phones = array($phones);
      if (!in_array($phone, $phones)) $phones[] = $phone;
      Message::updateThread(array(
        'phone' => serialize($phones),
      ), $thread_key);
      $data = json_decode(file_get_contents(public_path() . '/json/messages/' . $thread_key . '.json'));
      $data[] = array(
        'timestamp' => $timestamp,
        'contmessage' => Input::get('contmessage'),
        'sender' => 'user',
      );
      $data = json_encode($data);
      file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
    }
    return json_encode(array('status' => 1));
  }

    public function postSendtoUser(){
      $timestamp = time();
      $thread_key = $this->threadKeyGenerator(Input::get('business_id'), Input::get('contactemail'));
      if (Input::get('sendbyphone')) {
        $business_name = Business::name(Input::get('business_id'));
        $text_message = 'From: ' . $business_name  .  "\n" . 'To: ' . Input::get('phonenumber') . "\n" . Input::get('messageContent') . "\n\nThanks for using FeatherQ";
        Notifier::sendFrontlineSMS($text_message, Input::get('phonenumber'), FRONTLINE_SMS_URL, FRONTLINE_SMS_SECRET);
      }
      $data = json_decode(file_get_contents(public_path() . '/json/messages/' . $thread_key . '.json'));
      $data[] = array(
        'timestamp' => $timestamp,
        'contmessage' => Input::get('messageContent'),
        'sender' => 'business',
      );
      $data = json_encode($data);
      file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
      $business_name = Business::name(Input::get('business_id'));
      $subject = 'Message From ' . $business_name;
      Notifier::sendEmail(Input::get('contactemail'), 'emails.messaging', $subject, array(
        'messageContent' => Input::get('messageContent'),
        'businessName' => $business_name,
      ));
      return json_encode(array('timestamp' => date("Y-m-d h:i A", $timestamp)));
    }

  public function postMessageList() {
    $messages = array();
    $list = Message::getMessagesByBusinessId(Input::get('business_id'));
    foreach ($list as $count => $thread) {
      $messages[] = array(
        'email' => $thread->email,
        'phone' => unserialize($thread->phone),
        'contactname' => $thread->contactname,
        'message_id' => $thread->message_id,
      );
    }
    return json_encode(array('messages' => $messages));
  }

  public function postMessageThread() {
    return $this->getMessageThread(Message::getThreadKeyByMessageId(Input::get('message_id')));
  }

  public function postPhoneList() {
    return json_encode(array('numbers' => unserialize(Message::getPhoneByMessageId(Input::get('message_id')))));
  }

    public function postBusinessUserThread(){
        $business_id = Input::get('business_id');
        $email = Input::get('email');
        $thread_key = Message::getThreadKeyByBusinessIdAndEmail($business_id, $email);
        return $this->getMessageThread($thread_key);
    }

    private function threadKeyGenerator($business_id, $email) {
        return md5($business_id . 'fq' . $email);
    }

    private function getMessageThread($thread_key){
        $message_content = array();
        $data = json_decode(file_get_contents(public_path() . '/json/messages/' . $thread_key . '.json'));
        foreach ($data as $count => $content) {
            $message_content[] = array(
                'timestamp' => date("Y-m-d h:i A", $content->timestamp),
                'content' => $content->contmessage,
                'sender' => $content->sender,
            );
        }
        return json_encode(array('contactmessage' => $message_content));
    }

}