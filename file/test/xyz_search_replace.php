<?php
// does global search for $1 and replaces with $2
// CLI only!

define('DEFAULT_FN_FILTER', '/./');		// i.e. any character

$usage     = "Usage:\nphp search_replace.php <SEARCH> [<REPLACE>] [<START_DIR>] [<REGEX>] [<CASE>]\n"
           . "      If (string) REPLACE is blank, only does search\n"
           . "      If (string) START_DIR is blank, defaults to current directory\n"
           . "      If (string) REGEX is blank, includes all files from starting directory\n"
           . "      If (int) CASE is blank, defaults to 1 == case sensitive; set to 0 for case insensitive\n";

$search    = $argv[1] ?? '';
$replace   = $argv[2] ?? '';
$start_dir = $argv[3] ?? __DIR__;
$pattern   = $argv[4] ?? DEFAULT_FN_FILTER;
$case      = $argv[5] ?? 1;
$found     = [];

// define functions
/**
 * Filters filenames based on regex
 * 
 * @param string $filename
 * @param string $pattern == regex
 * @return bool FALSE if filename matches pattern
 */
function filterByFn($item, $pattern = DEFAULT_FN_FILTER) 
{ 
	if ($pattern == DEFAULT_FN_FILTER) return TRUE;
	return !preg_match($pattern, $item); 
}
/**
 * Performs replacements
 * 
 * @param string $fn = filename
 * @param string $search == what to search for
 * @param string $replace == what to replace with
 * @param bool $case == TRUE == case sensitive
 * @return mixed == if $search is found, returns (string) $contents; FALSE otherwise
 */
function search($fn, $search) 
{
	if (!file_exists($fn)) return FALSE;
	$contents = file_get_contents($fn);
	if (strpos($contents, $search) !== FALSE) {
		return $contents;
	} else {
		return FALSE;
	}
}
/**
 * Performs replacements
 * 
 * @param string $fn = filename
 * @param string $search == what to search for
 * @param string $replace == what to replace with
 * @param bool $case == TRUE == case sensitive
 * @param string $contents == used if search/replace combined
 * @return bool TRUE == replacement OK; FALSE otherwise
 */
function replace($fn, $search, $replace, $case = TRUE, $contents = '') 
{
	if (!$contents) {
		if (!file_exists($fn)) return FALSE;
		$contents = file_get_contents($fn);
	}
	if ($case) {
		$contents = str_replace($search, $replace, $contents);
	} else {
		$contents = str_ireplace($search, $replace, $contents);
	}
	return file_put_contents($fn, $contents);
}

if (!$search) {
	echo $usage;
	exit('Unable to continue');
}

echo 'Searching for ' . $search . PHP_EOL;

$it = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($start_dir,  FilesystemIterator::SKIP_DOTS));

foreach($it as $name => $info) {
	if (!filterByFn($info)) {
		echo 'Processing: ' . $name . PHP_EOL;
		if ($contents = search($name, $search)) {
			$found[] = $name;
			if ($replace) {
				$success = replace($fn, $search, $replace, $case, $contents);
				echo 'Replacement: ';
				echo ($success) ? 'SUCCESS' : 'FAILED';
				echo PHP_EOL;
			}
		}
	}
}
echo "\nFound search string in: \n";
echo implode("\n", $found);
echo PHP_EOL;
