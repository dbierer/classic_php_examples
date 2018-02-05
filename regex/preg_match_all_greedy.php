<?php
$test = "<p>First Paragraph</p><p>Second Paragraph</p><p>Third Paragraph</p>";
$matches = array();

$pattern = '[<.*>(.*)</.*>]';        // Non Greedy use *? or "U" modifier
$positive = preg_match_all($pattern,$test,$matches);
echo "\n--------------------------------------\n";
echo "Greedy: $pattern\n";
echo "\n--------------------------------------\n";
echo ($positive) ? "MATCH" : "NO MATCH";
echo "\n";
var_dump($matches);


$pattern = '[<.*>(.*)</.*>]U';        // Non Greedy use *? or "U" modifier
$positive = preg_match_all($pattern,$test,$matches);
echo "\n--------------------------------------\n";
echo "Non-Greedy: $pattern\n";
echo "\n--------------------------------------\n";
echo ($positive) ? "MATCH" : "NO MATCH";
echo "\n";
var_dump($matches);
