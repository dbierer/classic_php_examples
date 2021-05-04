<?php
// Recursively scans a directory tree starting at $dir

// Counts lines in a file
function countLines($filename) {
	$count = 0;
	if (file_exists($filename)) {
		$fh = fopen($filename, 'r');
		if ($fh) {
			while (!feof($fh)) {
				$a = fgets($fh);
				$count++;
			}
			fclose($fh);
		}
	}	
	return $count;
}

// Scans directory; if it finds directory, calls itself
function recursiveScan($dir) {
	// get a list of files in this directory
	$output = '';
	$list = glob($dir . '/*');
	// loop through list
	foreach ($list as $item) {
		// if directory print and call this function again
		if (is_dir($item)) {
			$output .= "<tr bgcolor='yellow'><th colspan=3>$item</th></tr>";
			$output .= recursiveScan($item);
		// otherwise output info as a table row
		} else {
			$size = filesize($item);
			$lines = countLines($item);
			$output .= sprintf("<tr><td>%s</td><td>%d</td><td>%d</td></tr>", basename($item), $size, $lines);
		}
	}
	return $output;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Recursive Directory Scan</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	color: gray;
	text-align: right;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	color: green;
	border: thin solid black;
	text-align: left;
	}
</style>
</head>
<body>
<h1>Recursive Directory Scan</h1>
<table style="width: 600px;">
<tr><th>File / Directory Name</th><th>Size</th><th>Lines</th></tr>
<?php echo recursiveScan('/var/www/php_exp'); ?>
</table>
</body>
</html>
