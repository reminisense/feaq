
<?php

// Connect to gmail
$imapPath = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = $_POST['email'];
$password = $_POST['password'];

$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

$emails = imap_search($inbox,'FROM Facebook');

$output = '';

foreach($emails as $mail) {
  $headerInfo = imap_headerinfo($inbox,$mail);
  $output .= $headerInfo->subject.'<br/>';
  $output .= $headerInfo->toaddress.'<br/>';
  $output .= $headerInfo->date.'<br/>';
  $output .= $headerInfo->fromaddress.'<br/>';
  $output .= $headerInfo->reply_toaddress.'<br/>';
  $emailStructure = imap_fetchstructure($inbox,$mail);
  if(!isset($emailStructure->parts)) {
    $output .= imap_body($inbox, $mail, FT_PEEK);
  } else {
    //
  }
  echo $output;
  $output = '';
}

// colse the connection
imap_expunge($inbox);
imap_close($inbox);