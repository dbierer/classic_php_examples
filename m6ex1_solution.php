<?php 
$email = (isset($_POST['email'])) ? strip_tags($_POST['email']) : '';
$pattern = '/^[A-Za-z0-9][A-Za-z0-9-._]*@([\w-_]+\.)+\w{2,6}$/';
if ($email) {
	if (preg_match($pattern, $email)) {
		$result = 'VALID';	
	} else {
		$result = 'NOT VALID';
	}
} else {
	$result = 'NOT SET';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GET / POST Lab</title>
</head>
<body>
<form method="post" action="?param=TEST&abc=XYZ">
Enter Email Address:
<br />
<input type="text" name="email" value="<?php echo $email; ?>"/>
<br />
ABC:
<br />
<input type="text" name="abc" />
<input type="submit" />
</form>
<br />
Email Address: 
<?php echo $result; ?>
<p>
<?php phpinfo(INFO_VARIABLES); ?>
</p>
</body>
</html>