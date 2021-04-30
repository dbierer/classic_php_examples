<?php
/*
 *      last_modified.php
 */
// Set header time
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
	$header_time = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
} else {
	$header_time = time();
}

// See if "time" is in environment
if (isset($_GET['time'])) {
	// If so, store it
	$env_time = strtotime($_GET['time']);
} else {
	// If not, place as rewrite variable
	$env_time = time();
	output_add_rewrite_var("time",$env_time);
}

// Check to see if modified
if ( $header_time > $env_time ) {
	header('304 Not Modified', TRUE, 304);
	exit;
} else {
	header("Last-Modified: " . gmdate('D, d M Y H:i:s \G\M\T',time()));
	// Set to expire in 5 seconds
	header("Expires: " . gmdate('D, d M Y H:i:s \G\M\T',time()+ 5));
	header("Pragma: cache");
	header("Cache-Control: public, must-revalidate, max-age=0");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Last Modified Example</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<h1>Last Modified Example</h1>
<p><b>Header Time      : </b><?php echo @$header_time; ?>
<br><b>Environment Time : </b><?php echo @$env_time; ?>
<form name="ModifiedTest" action="last_modified.php" method=GET>
<br><input type=submit name="Refresh" value="REFRESH" />
</form>
<br><a href="index.php">BACK</a>
<p>Refresh this page and check the header details.</p>
<br>1111 2222 3333 4444 5555 6666 7777 8888 9999 0000
<br>0000 1111 2222 3333 4444 5555 6666 7777 8888 9999
<br>9999 0000 1111 2222 3333 4444 5555 6666 7777 8888
<br>8888 9999 0000 1111 2222 3333 4444 5555 6666 7777
<br>7777 8888 9999 0000 1111 2222 3333 4444 5555 6666
<br>6666 7777 8888 9999 0000 1111 2222 3333 4444 5555
<br>5555 6666 7777 8888 9999 0000 1111 2222 3333 4444
<br>4444 5555 6666 7777 8888 9999 0000 1111 2222 3333
<br>3333 4444 5555 6666 7777 8888 9999 0000 1111 2222
<br>2222 3333 4444 5555 6666 7777 8888 9999 0000 1111
<br>1111 2222 3333 4444 5555 6666 7777 8888 9999 0000
<br>0000 1111 2222 3333 4444 5555 6666 7777 8888 9999
<br>9999 0000 1111 2222 3333 4444 5555 6666 7777 8888
<br>8888 9999 0000 1111 2222 3333 4444 5555 6666 7777
<br>7777 8888 9999 0000 1111 2222 3333 4444 5555 6666
<br>6666 7777 8888 9999 0000 1111 2222 3333 4444 5555
<br>5555 6666 7777 8888 9999 0000 1111 2222 3333 4444
<br>4444 5555 6666 7777 8888 9999 0000 1111 2222 3333
<br>3333 4444 5555 6666 7777 8888 9999 0000 1111 2222
<br>2222 3333 4444 5555 6666 7777 8888 9999 0000 1111
</body>
</html>
