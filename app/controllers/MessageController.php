<?php

class MessageController extends BaseController {

  public function postSendtoBusiness() {
    $business_id = Input::get('business_id');
    $email = Input::get('contemail');
    $name = Input::get('contname');
    $timestamp = time();
    $thread_key = $this->threadKeyGenerator($business_id, $email);

    if (!Message::checkThreadByKey($thread_key)) {
      Message::createThread(array(
        'contactname' => $name,
        'business_id' => $business_id,
        'email' => $email,
        'phone' => serialize(Input::get('contmobile')),
        'thread_key' => $thread_key,
      ));
      $data = json_encode(array(
        $timestamp => Input::get('contmessage'),
      ));
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
      $data->$timestamp = Input::get('contmessage');
      $data = json_encode($data);
      file_put_contents(public_path() . '/json/messages/' . $thread_key . '.json', $data);
    }
    return json_encode(array('status' => 1));
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
    $message_content = array();
    $data = json_decode(file_get_contents(public_path() . '/json/messages/' . Message::getThreadKeyByMessageId(Input::get('message_id')) . '.json'));
    foreach ($data as $timestamp => $content) {
      $message_content[] = array(
        'timestamp' => date("Y-m-d h:i A", $timestamp),
        'content' => $content,
      );
    }
    return json_encode(array('contactmessage' => $message_content));
  }

  private function threadKeyGenerator($business_id, $email) {
    return md5($business_id . 'fq' . $email);
  }

}