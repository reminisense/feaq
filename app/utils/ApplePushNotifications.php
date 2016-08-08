<?php

/**
 * Created by IntelliJ IDEA.
 * User: Polljii143
 * Date: 8/3/16
 * Time: 3:51 PM
 */
class ApplePushNotifications
{

  private $deviceToken; // 'ad648e26c765d78bad945eaf7eed7b192ffe6ed47fbfcfe973a11e7ed96931f2'
  private $passphrase = '';
  private $message;

  public function __construct($deviceToken, $message)
  {
    $this->deviceToken = $deviceToken;
    $this->message = $message;
  }

  public function sendNotif() {
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', app_path() . '/certs/featherqiosapn.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);

    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

    if (!$fp) exit("Failed to connect: $err $errstr" . PHP_EOL);
    echo 'Connected to APNS' . PHP_EOL;

    // Create the payload body
    $body['aps'] = array(
      'alert' => $this->message,
      'sound' => 'default',
    );
    $payload = json_encode($body);
    $msg = chr(0) . pack('n', 32) . pack('H*', $this->deviceToken) . pack('n', strlen($payload)) . $payload; // Build the binary notification
    $result = fwrite($fp, $msg, strlen($msg)); // Send it to the server
    if (!$result) echo 'Message not delivered' . PHP_EOL;
    else echo 'Message successfully delivered' . PHP_EOL;
    fclose($fp); // Close the connection to the server
  }

}