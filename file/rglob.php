<?php

function rglob($pattern, $flags = 0, $path = '') {
    if (!$path && ($dir = dirname($pattern)) != '.') {
        if ($dir == '\\' || $dir == '/') $dir = '';
        return rglob(basename($pattern), $flags, $dir . '/');
    }
    $paths = glob($path . '*', GLOB_ONLYDIR | GLOB_NOSORT);
    $files = glob($path . $pattern, $flags);
    foreach ($paths as $p) $files = array_merge($files, rglob($pattern, $flags, $p . '/'));
    return $files;
}

if (isset($_GET['OK'])) {
	$pattern 	= $_GET['pattern'];
	$path		= $_GET['path'];
	$result 	= rglob($pattern, 0, $path);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Recursive Glob</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<h1>Recursive Glob</h1>
<form name="Recursive Glob" method=GET>
<br>Enter Search Pattern: &nbsp;
<input type=text name="pattern" size=40 maxlength=255 />
<br>Enter Search Path: &nbsp;
<input type=text name="path" size=40 maxlength=255 />
<br><input type=submit name="OK" value="OK" />
</form>
<?php
if (isset($result)) {
	foreach ( $result as $file ) {
		echo "<br>" . $file; 
	}
}
echo '<br><a href="index.php">BACK</a>';
phpinfo(INFO_VARIABLES);
?>

</body>
</html>
