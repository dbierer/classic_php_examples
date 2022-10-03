<?php
// CURL example
// Runs currency conversion between Thai Bath and USD

$url = 'http://www.xe.com/ucc/convert.cgi';
$curl_data = [
	'Amount=1.0',
	'From=THB',
	'To=USD'
];
$options = [
	CURLOPT_POST   	       => 1,	// i am sending post data
	CURLOPT_POSTFIELDS 	   => $curl_data,// this are my post vars
	CURLOPT_VERBOSE		   => 1, 	// obvious
	CURLOPT_RETURNTRANSFER => true, // return web page
	CURLOPT_HEADER 		   => false,// don't return headers
	CURLOPT_FOLLOWLOCATION => true, // follow redirects
	CURLOPT_ENCODING   	   => "",   // handle all encodings
	CURLOPT_USERAGENT  	   => "Firefox", // who am i
	CURLOPT_AUTOREFERER    => true, // set referer on redirect
	CURLOPT_CONNECTTIMEOUT => 120,  // timeout on connect
	CURLOPT_TIMEOUT	       => 120,  // timeout on response
	CURLOPT_MAXREDIRS      => 10,   // stop after 10 redirects
	CURLOPT_SSL_VERIFYPEER => false,	// DO NOT use this option in production!!!
	CURLOPT_SSL_VERIFYSTATUS => false,	// DO NOT use this option in production!!!
	CURLOPT_SSL_VERIFYHOST => 0,		// DO NOT use this option in production!!!
	CURLOPT_SSL_OPTIONS    => CURLSSLOPT_NO_REVOKE,
];

$ch  = curl_init($url);
if (empty($ch)) exit('Bad CURL Connection');

// NOTE: this doesn't work in PHP 8!
// if (!is_resource($ch)) exit('Bad CURL Connection');

curl_setopt_array($ch,$options);
$content = curl_exec($ch);
$err     = curl_errno($ch);
$errmsg  = curl_error($ch) ;
$info    = curl_getinfo($ch);
curl_close($ch);

// view results
var_dump($content, $err, $errmsg, $info);
