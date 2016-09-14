<?php
$test = 'To this,ha ha,I say tally ho. Ta ta. "Ha hah"';
// $words = explode(' ', $test);
$words = array();
preg_match_all('/\w+?\b/', $test, $words);
var_dump($words);
?>