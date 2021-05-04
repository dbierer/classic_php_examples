<?php
// NOTE: 3 php.ini settings affect this process:
/*
upload_max_filesize --> defaults to 2M and must be less than:
post_max_size --> defaults to 8M and must be less than:
memory_limit --> defaults to 128M
see:
http://uk.php.net/manual/en/ini.core.php#ini.upload-max-filesize
http://uk.php.net/manual/en/ini.core.php#ini.post-max-size
http://uk.php.net/manual/en/ini.core.php#ini.memory-limit
Also, if you have problems, see:
http://stackoverflow.com/questions/11361149/how-can-i-prevent-large-apache-php-file-uploads-from-failing
 */
// Initialize Variables
$message = "";
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

// Check to see if OK button was pressed
if ( isset($_POST['OK'])) {

	// Check to see if upload parameter specified
	if ( $_FILES['file_to_upload']['error'] == UPLOAD_ERR_OK ) {

		// Check to make sure file uploaded by upload process
		if ( is_uploaded_file ($_FILES['file_to_upload']['tmp_name'] ) ) {
			
			// Capture filename
			$fn = strip_tags(basename($_FILES['file_to_upload']['name']));

			// Build new filename with safety measures in place
			$copyfile = $dir . 'safe_prefix_' . $fn;
		
			// Copy file
			if ( move_uploaded_file ($_FILES['file_to_upload']['tmp_name'], $copyfile) ) {
				$message .= "<br>Successfully uploaded file $copyfile\n";
			} else {
				// Trap upload file handle errors
				$message .= "<br>Unable to upload file " . $fn;
			}
			
		} else {
			// Failed security check
			$message .= "<br>File Not Uploaded!";
		}
		
	} else {
		// No photo file; return blanks and zeros
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
<input type="text" name="name" />
<br />
<input type="file" size=50 maxlength=255 name="file_to_upload" value="" />
<br />
<input type="submit" name="OK" value="OK" />
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
