<?php
// Test emails
if (isset($_POST['email'])) {
	$email = $_POST['email'];
	// Create regex				
	$pattern = "/^[a-z0-9-_\.]+\@[a-z0-9-_\.]\.[a-z]{2,4}$/i";
	// Validation
	if (preg_match($pattern, $email)) {
		$output="your e-mail address looks great!";
	} else {
		$output="your e-mail address does not appear to be valid";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<form method="POST">
Enter Email Address:<br>
<input type="text" size=60 maxlength=255 name="email" value="Your Email Address" />
<br>
<input type="submit" />
</form>
<br>
<?php echo @$output; ?>
</body>
</html>
