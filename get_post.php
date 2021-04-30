<?php
/*
 *      get_post.php
 */
$get_data = "GET----------------11111111111111111111111111111111111111111------------GET";
$post_data = "POST----------------22222222222222222222222222222222222222222------------POST";
?>
<!DOCTYPE html>
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
<input type=hidden name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" />
</form>
<br><a href="index.php">BACK</a>
<?php echo strip_tags($_POST["test"]); ?>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
