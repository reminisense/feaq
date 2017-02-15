<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 8/3/16
 * Time: 3:51 PM
 */
class ApplePushNotifications
{

  private $deviceToken;
  private $passphrase = '';
  private $message;
  private $terminal_name;
  private $msg_type;

  public function __construct($deviceToken, $message, $terminal_name, $msg_type)
  {
    $this->deviceToken = $deviceToken;
    $this->message = $message;
    $this->terminal_name = $terminal_name;
    $this->msg_type = $msg_type;
  }

  public function sendNotif() {
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', app_path() . '/certs/featherqiosapn.pem');
//    stream_context_set_option($ctx, 'ssl', 'local_cert', app_path() . '/certs/featherq_dist_apns.pem'); // uncomment when deployed to production
    stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);

    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
//    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // uncomment when deployed to production

    if (!$fp) exit("Failed to connect: $err $errstr" . PHP_EOL);
//    echo 'Connected to APNS' . PHP_EOL;

    // Create the payload body
    $body['aps'] = array(
      'alert' => $this->message,
      'terminal_name' => $this->terminal_name,
      'msg_type' => $this->msg_type,
      'sound' => 'default',
    );
    $payload = json_encode($body);
    $msg = chr(0) . pack('n', 32) . pack('H*', $this->deviceToken) . pack('n', strlen($payload)) . $payload; // Build the binary notification
    $result = fwrite($fp, $msg, strlen($msg)); // Send it to the server
//    if (!$result) echo 'Message not delivered' . PHP_EOL;
//    else echo 'Message successfully delivered' . PHP_EOL;
    fclose($fp); // Close the connection to the server
  }

}