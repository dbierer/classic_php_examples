<?php
// Target URL: http://www.sciencekids.co.nz/images/pictures/flags96/Afghanistan.jpg
$imagePattern = 'http://www.sciencekids.co.nz/images/pictures/flags96/%s.jpg';
$contents = file_get_contents('http://www.sciencekids.co.nz/pictures/flags.html');
$pattern = '!img src="../images/pictures/flags96/(.+?).jpg" alt="Flag of (.+?)" width="96!';
preg_match_all($pattern, $contents, $matches);
$flags = array_combine($matches[1],$matches[2]);
var_dump($flags);

