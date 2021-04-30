<?php
// Initialize Variables
$message = "";
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

// Check to see if OK button was pressed
if ( isset($_POST['OK'])) {
	// Check to see if upload parameter specified
	if ( $_FILES['upload']['error'] == UPLOAD_ERR_OK ) {
		// Check to make sure file uploaded by upload process
		if ( is_uploaded_file ($_FILES['upload']['tmp_name'] ) ) {
			// Capture filename
			$fn = strip_tags(basename($_FILES['upload']['name']));
			// Build path to ../uploads directory
			$copyfile = $dir . $fn;
			// Copy file
			if ( move_uploaded_file ($_FILES['upload']['tmp_name'], $copyfile) ) {
				$message .= "<br>Successfully uploaded file " . htmlentities($fn) . "\n";
			} else {
				// Trap upload file handle errors
				$message .= "<br>Unable to upload file " . htmlentities($fn) . "\n";
			}			
		} else {
			// Failed security check
			$message .= "<br>File Not Uploaded!";
		}
	} else {
		// Failed security check
		$message .= "<br>No Upload File Specified\n";
	}
}	

// Scan directory
$list = glob($dir . "*");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Upload File</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<h1>Upload File</h1>
<form name="Upload" method="POST" enctype="multipart/form-data">
<input type=file size=50 maxlength=255 name="upload" value="" />
<br><input type=submit name="OK" value="OK" />
</form>
<table cellspacing=4>
<tr><th>Filename</th><th>Last Modified</th><th>Size</th></tr>
<?php
if (isset($list)) {
	foreach ($list as $item) {
		echo "<tr><td>$item</td>";
		echo "<td>" . date ("F d Y H:i:s", filemtime($item)) . "</td>";
		echo "<td align=right>" . filesize($item) . "</td>";
		echo "</tr>\n";
	}
}
echo "</table>\n";
echo '<br><a href="index.php">BACK</a>';
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
