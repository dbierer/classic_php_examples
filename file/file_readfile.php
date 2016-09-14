<?php
$fn = dirname(__FILE__) . '/' . strip_tags($_GET['f']);
header('Content-type: image/jpeg');
$version = "1.0.0_2010-07-22";
$etag = md5($version);
$none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : "";
if ( $none_match == $etag ) {
	header('304 Not Modified', TRUE, 304);
} else {
	header("ETag: $etag");
	if (file_exists($fn)) {
		readfile($fn);
	}
}
?>