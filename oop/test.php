<?php
$url = 'https://www.google.com';
$ch  = curl_init();
if (empty($ch)) exit('Unable to open connection');
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
var_dump($result);
curl_close($ch);