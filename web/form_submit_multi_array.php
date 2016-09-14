<?php 
$error = "";
if (isset($_POST['submit'])) {
	if (isset($_POST['address']['postcode'])) {
		if (!preg_match('/^[\w ]+$/', $_POST['address']['postcode'])) {
			$error = "<p style='color:red;'><b>ERROR:</b>Postcode must be letter or numbers only!</p>";
		}
	} 
}
?>
<!DOCTYPE html>
<html>
<body>
<form method=POST>
<input type="checkbox" name="option[key1][]" value="opt1">1
<input type="checkbox" name="option[key1][]" value="opt2">2
<input type="checkbox" name="option[key2][]" value="opt3">3
<input type="checkbox" name="option[key2][]" value="opt4">4
<table>
<tr><th>Address 1</th><td><input type="text" name="address[line1]" /></td></tr>
<tr><th>Address 2</th><td><input type="text" name="address[line2]" /></td></tr>
<tr><th>City </th><td><input type="text"     name="address[city]" value='City' /></td></tr>
<tr><th>Postcode </th><td><input type="text" name="address[postcode]" /></td></tr>
<tr><th>Email</th><td><input type="email" required="required" name="email" /></td></tr>
</table>
<br /><input type="submit" name="submit" value="GO" />
</form>
<?php echo $error; ?>
<p>
<?php echo isset($_POST['address']['line1']) ? $_POST['address']['line1'] : 'NOT SET'?>
<?php 
if (isset($_POST['address'])) {
	foreach ($_POST['address'] as $key => $value) {
		echo '<br />' . $key . ': ' . $value;
	}
}
?>
</p>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>