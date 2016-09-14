<?php
$host = "training.zblog";
$header = 'Authorization: Basic '.base64_encode('admin:test')."\r\n";
$header .= 'Cookie: '.session_name().'='.md5(microtime())."\r\n";
$context = stream_context_create( array ('http' => array( 'header' => $header )));
$url = 'http://' . $host . '/admin/?useHttpAuth=1';
$fh = fopen("$url", 'r', null, $context);
stream_filter_append($fh, "string.toupper", STREAM_FILTER_READ);
$content = '';
while (!feof($fh)) {
	$content .= fread($fh, 1024);
}
var_dump(stream_get_meta_data($fh));
fclose($fh);
echo "<span style='font: 10pt helvetica, sans;'>";
echo "<p>" . $content . "</p>\n";
echo "<p>" . htmlentities($content) . "</p></span>";
?>
