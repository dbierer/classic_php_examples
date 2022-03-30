<?php
/*
 *      etag.php
 */
// Set eTag
$etag = "1.0.0_2013-06-04";

//$etag_match = $etag . "-gzip";
$none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : "";
if ( $none_match == $etag ) {
	header('304 Not Modified', TRUE, 304);
	exit;
} else {
	header("ETag: $etag");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>ETag Example June 2013</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<h1>ETag Example</h1>
Refresh this page and check the header details.

<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br>aaaa bbbb cccc dddd eeee ffff gggg hhhh iiii jjjj
<br>kkkk llll mmmm nnnn oooo pppp qqqq rrrr ssss tttt
<br><a href="index.php">BACK</a>
</body>
</html>
