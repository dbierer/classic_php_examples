<?php
// Initialize variables
$choice = '';
$name 	= '';
$value  = 0;
$state  = '';
// Check to see if "choice" is set
if (isset($_GET['choice'])) {
	// Assign either/or values
	$state = strtoupper(strip_tags($_GET['choice']));
	$choice = ($state == "NY") ? "New York" : "California";
}
// Assign name from environment if set
$name = (isset($_GET['name'])) ? strip_tags($_GET['name']) : 'Guest';
// Assign value if set using short ternary operator
$value = (int) @$_GET['value'] ?: 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Ternary Example</title>
</head>
<body>
<h1>Ternary Example</h1>
<form name="Ternary Example" method=GET>
Enter Your Name:
<br /><input type=text name="name" value="<?php echo $name; ?>" />
<br />Select a State:
<br /><input type=radio name="choice" value="NY" <?php echo ($state == 'NY') ? 'checked' : '';?> />&nbsp;NY
<br /><input type=radio name="choice" value="CA" <?php echo ($state == 'CA') ? 'checked' : '';?> />&nbsp;CA
<br />Select a Value:
<select name="value">
<option>Choose</option>
<option <?php echo ($value == 1) ? 'selected' : '';?>>1</option>
<option <?php echo ($value == 2) ? 'selected' : '';?>>2</option>
<option <?php echo ($value == 3) ? 'selected' : '';?>>3</option>
</select>
<br /><input type=submit name="OK" value="OK" />
</form>
<br /><b>RESULT: </b>
<br />
<?php printf("Choice: %s<br />Value: %d", $choice, $value); ?>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
