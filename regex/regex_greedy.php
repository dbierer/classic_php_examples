<?php
$test = "<p>First Paragraph<ul><li>First</li><li>Second</li></ul></p><p>Second Paragraph</p>";
$pattern = '/<.*>/';		// Non Greedy use *? or "U" modifier
$matches = array();
$positive = preg_match_all($pattern,$test,$matches);
echo ($positive) ? "MATCH" : "NO MATCH";
echo "\n";
var_dump($matches);
?>
