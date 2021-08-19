<?php
// Poor man's "View Source" function
if (isset($_GET['url'])) {
	if ( $fh = fopen ( $url, "r" ) ) {
		while ( $line = fgets($fh)) {
			$contents[] = htmlentities($line);
		}
		fclose($fh);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>View Source</title>
</head>
<body>
<h1>View Source</h1>
<?php 
if (isset($contents)) {
	echo "<h3>" . $url . "</h3>\n";
	foreach ($contents as $line) {
		echo "<br>" . $line . "\n";
	}
}
?>
<form name="ViewSource" method=GET>
<input name="url" type=text size=60 maxlength=255 />
<br>
<input type=submit name="OK" value="OK" />
</form>
<?php 
if ($message) { echo $message; } 
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
