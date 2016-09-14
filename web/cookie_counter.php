<?php
// Get the value of the submit button using $_REQUEST['name_of_submit_button']
$button = isset($_REQUEST['action']) ? htmlentities($_REQUEST['action']) : "";
$counter = isset($_COOKIE['counter']) ? (int) $_COOKIE['counter'] : 0;
// Test to see if == "+"
if ( $button == "+" ) {
	// If so then increment the counter
	$counter++;
} else {
	// Otherwise decrement the counter
	$counter--;
}
setcookie("counter", $counter, time()+300, '/');
// Process name
if (isset($_COOKIE['name'])) {
	$name = $_COOKIE['name'];
} elseif (isset($_GET['name'])) {
	$name = $_GET['name'];
	setcookie("name", $name, time()+300, '/');
} else {
	$name = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Counter Example Using Cookies</title>
</head>
<body>
<h1>Counter Example Using Cookies</h1>
<p>&nbsp;</p>
<form name="Cookie" method=GET>
<?php 
if ($name) {
	echo "<b>Hello " . strip_tags($name) . "</b><br>\n"; 
} else {
	echo "<br>Please enter your name:\n";
	echo "<br><input type=text name='name' size=40 maxlength=64>\n";	
	echo "<br><input type=submit name='OK' value='OK'>\n";	
}
?>
<table border=0>
<tr><td><input type=submit name="action" value="+"></td>
<td><input type=submit name="action" value="-"></td></tr>
</table>
</form>
<br>
<b>COUNTER:</b>&nbsp;
<?php 
// Display the current value of the counter here:
echo htmlspecialchars($counter);
?>
<br><a href="index.php">BACK</a>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
