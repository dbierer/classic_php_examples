<?php
// M3Ex7.php -- streams exercise
$header = 'Authorization: Basic '.base64_encode('administrator:password')."\r\n"; 
$header .= 'Cookie: '.session_name().'='.md5(microtime())."\r\n"; 
$context = stream_context_create( 
	array ( 
		'http' => 
			array( 
				'header' => $header 
			) 
	) 
); 

$fh = fopen('http://zblogapp.work/admin/?useHttpAuth=1', 'r', null, $context); 
$content = ''; 
while (!feof($fh)) { 
	$content .= fread($fh, 1024); 
} 
fclose($fh); 
echo '<pre>' . strip_tags($content) . '</pre>';
