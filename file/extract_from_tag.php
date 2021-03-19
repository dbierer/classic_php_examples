<?php
// looks for files matching $pattern, extracts contents of tag $tag
// writes out files as sequential numbers based on $index tag

// init vars
$usage = "Usage:\nextract_from_tag.php <TAG> <FILE>\n"
		. "      If (string) TAG needs to be an HTML tag to search for\n"
		. "      If (string) FILE filename to be parsed\n";

// grab params
$tag        = $argv[1] ?? '';
$fn         = $argv[2] ?? __DIR__;
$pattern    = '!<%s.*?>(.*?)</%s!im';
$pattern    = sprintf($pattern, $tag, $tag);;

if (!$tag || !$fn || !file_exists($fn)) {
	echo $usage;
	exit;
}

$contents = file_get_contents($fn);
$contents = str_replace(["\r","\n"], ['','%%'], $contents);
preg_match_all($pattern, $contents, $match);

if ($match[1]) {
	$code = implode("\n\n", $match[1]);
	$code = str_replace('%%', "\n", $code);
	echo $code;
} else {
	echo 'No matches found';
}
echo PHP_EOL;
