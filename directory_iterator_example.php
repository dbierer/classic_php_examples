<?php
function show($dir) {
	// Scan through directory
	$output = '';
	foreach (new DirectoryIterator($dir) as $fileInfo) {
		// Weed out "." and ".."
		if(!$fileInfo->isDot()) {
			$f = $fileInfo->getFilename();
			$output .= "<tr><td align='left'>$f</td>";
			$output .= '<td><input type=radio name="View" value="' . $f . '"></td>';
			$output .= '</tr>' . PHP_EOL;
		}
	}
	return $output;
}

echo '<table>' . PHP_EOL;
echo show('.');
echo '</table>' . PHP_EOL;
