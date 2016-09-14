<?php
/*
 *      get_post.php
 */
$get_data = "GET----------------11111111111111111111111111111111111111111------------GET";
$post_data = "POST----------------22222222222222222222222222222222222222222------------POST";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>GET_POST Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<h1>GET Test</h1>
<form name="GetTest" method="GET">
<br><input type=text name="get_data" size=60 value="<?php echo $get_data; ?>" />
<br><input type=text name="test" size=60 value="" />
<br><input type=submit name="OK" value="GET" />
</form>
<hr>
<h1>POST Test</h1>
<form name="PostTest" method=POST>
<br><input type=text name="post_data" size=60 value="<?php echo $post_data; ?>" />
<br><input type=text name="test" size=60 value="" />
<br><input type=submit name="OK" value="POST" />
</form>
<br><a href="index.php">BACK</a>
<?php echo strip_tags($_POST["test"]); ?>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
