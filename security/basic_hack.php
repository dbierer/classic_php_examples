<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>PHP Security - Basic Hack</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<h1>Basic Hack</h1>
<?php
$username = (isset($_REQUEST['userName']))? $_REQUEST['userName'] : ""; 
if ($username) {
	echo "Welcome Back " . $username . "!<br>\n";
}
?>
<form name="BasicHack" method="POST">
Enter Username: &nbsp;
<input type=text name="userName">
<br>
<input type=submit name="OK" value="OK">
</form>
<?php phpinfo(INFO_VARIABLES);?>
</body>
</html>
