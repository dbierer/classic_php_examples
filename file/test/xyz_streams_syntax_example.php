<?php
// Get list of files
$dir = dirname($_SERVER["SCRIPT_FILENAME"]) . DIRECTORY_SEPARATOR . "*";  
$files = glob($dir);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Stream Wrapper Example</title>
</head>
<body>
<h1>Stream Wrapper Example</h1>
<!--  This is how the same script is called -->
<form name="StreamWrapper" method=GET>
<table>
	<tr>
		<th>File</th>
		<td><input type=radio name="action" value="File" /></td>
		<td>
			<select name="filename">
			<?php
				foreach ($files as $item ) {
					echo "<option>$item</option>\n"; 
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<th>HTTP</th>
		<td><input type=radio name="action" value="HTTP" /></td>
		<td><input type=text size=60 maxlength=255 name="data" title="Enter URL" /></td>
	</tr>
</table>
<br><input type=submit name="OK" value="OK" />
</form>
<?php
// Get Choice
if ( isset($_GET['OK'])) {
	$action = $_GET['action'];
	$data = $_GET['data'];
	switch ( $action ) {
		case "File" :
			$data = $_GET['filename'];
			break;
	}
	if ( $fh = fopen($data, 'r') ) {
		$result = stream_get_meta_data($fh);
		foreach ( $result as $key => $value ) {
			echo "<b>$key:</b><br>\n";
			if (is_array($value)) {
				echo "<ul>";
				foreach ( $value as $item ) {
					echo "<li>";
					if ( is_bool($item)) {
						echo $item ? "TRUE" : "FALSE";
					} else {
						echo $item;
					}
					echo "</li>\n";
				}
				echo "</ul>\n";
			} else {
				echo "<ul>";
				echo "<li>";
				if ( is_bool($value)) {
					echo $value ? "TRUE" : "FALSE";
				} else {
					echo $value;
				}
				echo "</li>\n";
				echo "</ul>\n";				
			}
		}
		fclose($fh);
		echo "<p>";
		var_dump($result);
		echo "</p>\n";
	} else {
		echo "<p><b style='color: red;'>ERROR: </b>Unable to open resource\n";
	}
}
?>
<br><a href="index.php">BACK</a>
<?php phpinfo(INFO_VARIABLES); ?>
</body>
</html>