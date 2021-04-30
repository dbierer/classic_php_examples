<?php
// Get the value of the submit button using $_GET['name_of_submit_button']
$button = isset($_GET['action']) ? $_GET['action'] : "X";
$counter = isset($_GET['counter']) ? (int) $_GET['counter'] : 0;

// Check to see if name is set
$name_form = "";
if ( isset($_GET['name']) ) {
	$name = strip_tags($_GET['name']);
	$name_form .= "<b>Hello " . $name . "</b><br>\n";
	$name_form .= "<input type=hidden name='name' value='" . $name . "'>\n"; 
} else {
	$name_form .= "<br>Please enter your name:\n";
	$name_form .= "<br><input type=text name='name' size=40 maxlength=64>\n";	
	$name_form .= "<br><input type=submit name='OK' value='OK'>\n";	
}

// Test to see if == "+"
if ( $button == "+" ) {
	// If so then increment the counter
	$counter++;
} elseif ( $button == "-" ) {
	// Otherwise decrement the counter
	$counter--;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Counter Example Using Hidden Variables</title>
</head>
<body>
<h1>Counter Example Using Hidden Variables</h1>
<p>&nbsp;</p>
<form name="Session" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php echo $name_form; ?>
<table border=0>
<tr><td><input type=submit name="action" value="+"></td>
<td><input type=submit name="action" value="-"></td></tr>
</table>
<input type=hidden name="counter" value="<?php echo @$counter; ?>">
</form>
<br>
<b>COUNTER:</b>&nbsp;
<?php echo $counter; ?>
<br><a href="index.php">BACK</a>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
