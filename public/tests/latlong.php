<?php

$ip = '121.96.255.102';
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
print_r($details); // -> "Mountain View"