<?php
// Safely store incoming email into a variable $email
$email = (isset($_POST["email"])) ? trim($_POST["email"]) : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Email Validation</title>
</head>
<body>
<h1>Email Validation</h1>
<form name="Valid" method=POST>
Please Enter an Email Address:
<!-- Use htmlspecialchars() or htmlentities() when outputting user-supplied data!!! -->
<br><input type=text size=50 maxlength=255 name="email" value="<?php echo htmlspecialchars($email); ?>">
<br><input type=submit name="OK" value="OK">
</form>
<p>
<?php 
// Perform email validation using preg_match
$pattern = "/^[A-Za-z0-9-\._]+@([\w-_]+\.)+[\w+]{2,4}$/";
// Output $message as either "VALID" or "NOT VALID"
echo preg_match($pattern , $email) ? "$email Valid" : "$email NOT Valid";
?>
</p>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
