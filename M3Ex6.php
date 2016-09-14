<?php
// M3Ex6.php -- directories and files exercise
function numLines($fileName) {
	if (preg_match('/\.(png|jpg)$/i', $fileName)) {
		$lines = 'N/A';
	} else {
		$fh = (file_exists($fileName)) ? fopen($fileName, 'r') : FALSE;
		$lines = 0;
		if ($fh) {
			while (!feof($fh)) { 
				$temp = fgets($fh);
				$lines++; 
			} 
			fclose($fh); 
		}
	}
	return $lines;
}

function dirScan($dir) {
	$list = glob($dir . '/*');
	foreach ($list as $fn) {
		if (is_dir($fn)) {
			printf('<tr><th colspan=3 align=left>%s</th></tr>', $fn);
			dirScan($fn);
		} else {
			printf('<tr><td>%s</td><td>%d</td><td>%s</td></tr>',
					basename($fn), filesize($fn), numLines($fn));
		}
	}
}

?>
<html>
<body>
<table>
<tr><th>Filename</th><th>Size</th><th># Lines</th></tr>
<?php dirScan('/var/www/php_sec'); ?>
</table>
</body>
</html>