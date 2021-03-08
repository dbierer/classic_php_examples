<?php
/*
 *      etag.php
 */
// Set eTag
$etag = "1.0.1_2021-03-08";

//$etag_match = $etag . "-gzip";
$none_match = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
if ( $none_match == $etag ) {
	header('304 Not Modified', TRUE, 304);
	exit;
} else {
	header("ETag: $etag");
}
?>
<!DOCTYPE html>
<head>
<title>ETag Example</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<h1>ETag Example</h1>
NEW: ONLY FOR TODAY ... SPECIAL!!!

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
