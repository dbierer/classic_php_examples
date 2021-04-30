<?php
// uses preg_match_all to locate all HTML tags in a string and display the contents
//$string = "<p>the quick <b>brown fox</b> jumped over <b>the</b> fence the</p>";
$string = file_get_contents('http://www.unlikelysource.com/');
$pattern = "/<\w+>/U";
preg_match_all($pattern, $string, $matches);
echo "\n";
foreach ($matches[0] as $item) {
	$openTag = $item;
	$closeTag = substr($item, 0, 1) . '/' . substr($item, 1);
	$subPattern = '|' . $openTag . '.*?' . $closeTag . '|';
	preg_match_all($subPattern, $string, $subMatches);
	echo "\n\nHTML Tag: $openTag";
	foreach ($subMatches[0] as $contents) {
		$contents = str_ireplace(array($openTag, $closeTag), '', $contents);
		echo "\n\t$contents";
	}
}
?>