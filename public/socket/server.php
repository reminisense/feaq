<?php

/**
 * Basic Websocket Server for Process Queue & Broadast Page Updating
 *
 */

$host = '128.199.169.32';
//$host = 'localhost';
$port = '55346';
$null = NULL; // only variables can be passed by reference in socket_select function
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, 0, $port);
socket_listen($socket);

$clients = array($socket);
$business_sockets = array();

//start endless loop, so that our script doesn't stop
while (true) {
  $changed = $clients;
  socket_select($changed, $null, $null, 0, 10);
  if (in_array($socket, $changed)) {
    $socket_new = socket_accept($socket);
    $clients[] = $socket_new;
    $header = socket_read($socket_new, 5120);
    perform_handshaking($header, $socket_new, $host, $port);
    socket_getpeername($socket_new, $ip);
    $found_socket = array_search($socket, $changed);
    unset($changed[$found_socket]);
  }

  //loop through all connected sockets
  foreach ($changed as $changed_socket) {
    while(socket_recv($changed_socket, $buf, 1024, 0) >= 1) {
      $received_text = unmask($buf);
      $msg = json_decode($received_text);

      //store the business id of the connected sockets so that the server will know
      //what sockets are to be pinged rather than all the sockets
      if(isset($msg->business_id)){
        $resource_id = (string) $changed_socket;
        $business_sockets[$resource_id] = $msg->business_id;
        $response_text = mask(json_encode(array(
            'business_id' => $msg->business_id, // determines the business making the process
            'broadcast_update'=> $msg->broadcast_update, // determines if the broadcast page needs to be updated
            'broadcast_reload' => $msg->broadcast_reload, // determines if the broadcast page needs to be reloaded
        )));
        send_message($msg->business_id, $response_text);
      }
      break 2;
    }

    $buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
    if ($buf === false) {
      $found_socket = array_search($changed_socket, $clients);
      socket_getpeername($changed_socket, $ip);
      unset($clients[$found_socket]);
    }
  }
}
socket_close($socket);


function send_message($business_id, $msg)
{
  global $clients;
  global $business_sockets;
  foreach($clients as $changed_socket)
  {
    //we should check if the current socket has the same business id with the
    //business that is calling the number before sending the ping
    $resource_id = (string) $changed_socket;
    if (array_key_exists($resource_id, $business_sockets) && $business_sockets[$resource_id] == $business_id) {
      @socket_write($changed_socket, $msg, strlen($msg));
    }
  }
  return true;
}


//Unmask incoming framed message
function unmask($text) {
  $length = ord($text[1]) & 127;
  if($length == 126) {
    $masks = substr($text, 4, 4);
    $data = substr($text, 8);
  }
  elseif($length == 127) {
    $masks = substr($text, 10, 4);
    $data = substr($text, 14);
  }
  else {
    $masks = substr($text, 2, 4);
    $data = substr($text, 6);
  }
  $text = "";
  for ($i = 0; $i < strlen($data); ++$i) {
    $text .= $data[$i] ^ $masks[$i%4];
  }
  return $text;
}

//Encode message for transfer to client.
function mask($text)
{
  $b1 = 0x80 | (0x1 & 0x0f);
  $length = strlen($text);

  if($length <= 125)
    $header = pack('CC', $b1, $length);
  elseif($length > 125 && $length < 65536)
    $header = pack('CCn', $b1, 126, $length);
  elseif($length >= 65536)
    $header = pack('CCNN', $b1, 127, $length);
  return $header.$text;
}

//handshake new client.
function perform_handshaking($receved_header,$client_conn, $host, $port)
{
  $headers = array();
  $lines = preg_split("/\r\n/", $receved_header);
  foreach($lines as $line)
  {
    $line = chop($line);
    if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
    {
      $headers[$matches[1]] = $matches[2];
    }
  }

  $secKey = $headers['Sec-WebSocket-Key'];
  $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
  //hand shaking header
  $upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
    "Upgrade: websocket\r\n" .
    "Connection: Upgrade\r\n" .
    "WebSocket-Origin: $host\r\n" .
    "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
    "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
  socket_write($client_conn,$upgrade,strlen($upgrade));
}
