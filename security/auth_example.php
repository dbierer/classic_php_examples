<?php
$url = isset($_GET['url']) ? urldecode($_GET['url']) : "http://172.16.252.128/admin/PICT0144.JPG";
$header = 'Authorization=Basic:administrator:password\r\n";
$header .= 'Cookie: ' . session_name() . "=" . md5(microtime()) . "\r\n";
$context = 
	stream_context_create(array( 'http' => array ( 'header' => $header )));
$fh = fopen($url,"rb",null,$context);
while (!feof($fh)) {
	$content .= fread($fh,1024);
}
fclose($fh);
echo $content;
?>