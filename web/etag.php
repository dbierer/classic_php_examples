<?php

/*
 *      etag.php
 */
// Set eTag
$etag = md5(__FILE__) . filemtime(__FILE__);

//$etag_match = $etag . "-gzip";
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_contains($_SERVER['HTTP_IF_NONE_MATCH'], $etag)) {
	header('304 Not Modified', TRUE, 304);
	exit;
}
header('ETag: "' . $etag . '"');
$start = 3;
$end   = 10_000;
$prime = function ($start, $end) {
	yield from [0, 1, 2];
	for ($x = $start; $x < $end; $x++) {
		$test = TRUE;
		for($i = 3; $i < $x; $i += 2) {
			if(($x % $i) === 0) {
				$test = FALSE;
				break;
			}
		}
		if ($test) yield $x;
	}
};
$generator = $prime($start, $end);
?>
<!DOCTYPE html>
<head>
<title>ETag Example</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<h1>ETag Example</h1>
Prime numbers between <?= $start ?> and <?= $end ?>:
<br />
<?php foreach($generator as $num) echo $num . ' '; ?>
</body>
</html>
