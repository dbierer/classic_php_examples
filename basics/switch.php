<?php
// Get input from form
$amount = (isset($_GET['amount'])) ? (float) $_GET['amount'] : 0;
$denom  = (isset($_GET['denom'])) ? strip_tags($_GET['denom']) : 'USD';

// Function to determine currency symbol
function currency ( $symbol = NULL ) {
	switch($symbol) {
//		case 'MXN' || 'CAD' || 'AUD' || 'USD' :
		case 'MXN':
		case 'CAD':
		case 'AUD':
		case 'USD':
			$prefix = '$';
			break;
		case 'GBP': 
			$prefix = '£';
			break;
		case 'YEN':
			$prefix = '¥';
			break;
		case 'EUR':
			$prefix = '€';
			break;
		default : 
			$prefix = '$';
	}
	return $prefix;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Switch Example</title>
</head>
<body>
<h1>Switch Example</h1>
<form name="Switch Example" method=GET>
Enter the Amount:
<br><input type=text name="amount" value="<?php echo $amount; ?>" />
<br>Select a Currency:
<br><select name="denom">
		<?php 
			if (isset($denom)) {
				echo "<option>$denom</option>\n";
			}
		?>
		<optgroup label="-- or --">-- or --</optgroup>
		<option>AUD</option>
		<option>CAD</option>
		<option>EUR</option>
		<option>GBP</option>
		<option>MXN</option>
		<option>USD</option>
		<option>YEN</option>
	</select>
<br><input type=submit name="OK" value="OK" />
</form>
<?php 
if (isset($_GET['OK'])) {
	echo "<br><b>RESULT: </b>";
	echo currency($denom) . $amount;
}
?>
<br><a href="index.php">BACK</a>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>
