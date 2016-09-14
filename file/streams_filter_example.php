<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Encrypted Streams Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<?php
/* Read contents of test file  */
$contents = file_get_contents('gettysburg.txt');

/* Echo unfiltered contents */
echo "<h3>Unfiltered Output</h3><hr />\n";
echo "<pre>$contents</pre>\n";
echo "<p></p>\n";
echo "<h3>Filtered Output</h3><hr />\n";
echo "<pre>";

/* Open a test pipe for output  */
$f = fopen('php://output', 'w');

/* Apply the ROT13 filter to the write filter chain */
$sf = stream_filter_append($f, "string.rot13", STREAM_FILTER_WRITE);

/* Output to the stream */
fwrite($f, $contents, strlen($contents));

/* Remove filter to conserve memory */
stream_filter_remove($sf);

/* Close the output pipe */
fclose($f);

?>
</pre>
</body>
</html>
