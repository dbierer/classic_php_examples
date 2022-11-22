<?php
$usage = <<<EOT
usage: glob_file_strpos_printf_finds_lines_containing_search_string.php <SEARCH> [path] [only]
       if "only" is added, it only prints files where search string is found
EOT;
$search = $_GET['search'] ?? $argv[1] ?? '';
if (empty($search)) {
	echo $usage;
	exit;
}
$path   = $_GET['path'] ?? $argv[2] ??__DIR__ . '/*';
$only   = (bool) ($_GET['only']   ?? $argv[3] ?? FALSE);
$list = glob($path);
foreach ($list as $fn) {
	$found    = '';
	$contents = file($fn);
	if (function_exists('str_contains')) {
		// PHP 8+
		foreach ($contents as $num => $line)
			if (str_contains($line, $search))
				$found .= printf("%4d : %s\n", $num, $line);
	} else {
		foreach ($contents as $num => $line)
			if (strpos($line, $search) !== FALSE)
				$found .= printf("%4d : %s\n", $num, $line);
	}
	if ($only && !empty($found)) {
		echo "Scanned: $fn\n";
	} else {
		echo "Scanned: $fn\n";
	}
	echo $found;
}



