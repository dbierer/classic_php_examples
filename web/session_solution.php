<?php
// Initialize the session
if (isset($_GET['logout'])) {
	session_destroy();
} else {
	session_start();
}

// Get the value of the submit button using $_GET['name_of_submit_button']
$button = isset($_GET['action']) ? $_GET['action'] : "X";
$counter = isset($_SESSION['counter']) ? (int) $_SESSION['counter'] : 0;

// Test to see if == "+"
if ( $button == "+" ) {
	// If so then increment the counter
	$counter++;
} elseif ( $button == "-" ) {
	// Otherwise decrement the counter
	$counter--;
}
$_SESSION['counter'] = $counter;

// Process name
$name = "";
if (isset($_SESSION['name'])) {
	$name = $_SESSION['name'];
} elseif (isset($_GET['name'])) {
	$name = $_GET['name'];
	$_SESSION['name'] = $name;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Counter Example Using Session</title>
</head>
<body>
<h1>Counter Example Using Session</h1>
<p>&nbsp;</p>
<form name="Session" method=GET>
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
<br><input type=submit name="logout" value="Logout">
</form>
<br>
<b>COUNTER:</b>&nbsp;
<?php echo $counter; ?>
<br><a href="index.php">BACK</a>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
