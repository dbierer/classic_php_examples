<?php
/* For a completely valid XHTML document you have to set the arg_separator, 
 * use this before you use output-add-rewrite-var
 */

ini_set('arg_separator.input', '&');
ini_set('arg_separator.output', '&');
output_add_rewrite_var('ABC','DEF');
ob_implicit_flush(1);

$output = '';

if (isset($_POST['add'])) {
	$name = (isset($_POST['varName'])) ? strip_tags($_POST['varName']) : 'name';
	$value = (isset($_POST['varValue'])) ? strip_tags($_POST['varValue']) : 'value';
	$output .= "<br>Add URL Rewriter: " . $name . "/" . $value . "\n";
	output_add_rewrite_var($name,$value);
}
// Reset URL rewriter
if (isset($_POST['reset'])) {
	$output .= "<br>Reset URL Rewriter\n";
	output_reset_rewrite_vars();
}
// Compression
if (isset($_POST['type'])) {
	if ($_POST['type'] == "GZIP") {
		ob_start("ob_gzhandler");
		$output .= "<br>Compression: YES\n";
	} else {
		ob_start("");
		$output .= "<br>Compression: NO\n";
	}
} else {
	ob_start("");
	$output .= "<br>Compression: NO\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>OB Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<h1>Output Buffering Test</h1>
<a href="index.php">BACK</a>
<p><?php echo $output; ?></p>
<form name="Type" method=POST>
Add URL Rewriters:
<br>Name &nbsp; <input type=text name="varName" size=40 />
<br>Value &nbsp; <input type=text name="varValue" size=20 />
<br><input type=submit name="add" value="ADD" /> &nbsp;
<br>Reset URL Rewriters:
&nbsp;<input type=submit name="reset" value="RESET" /> &nbsp;
<br><input type=submit name="type" value="Normal" /> &nbsp;
<input type=submit name="type" value="GZIP" />
</form>
<?php phpinfo(INFO_VARIABLES) ?>
<br>Printing Lots of Data...
<br>
<?php
echo "<br>OB Level: " . ob_get_level() . "\n";
echo "<br>OB Handlers: " . ob_list_handlers() . "\n";
$max = 100;
$contents = file_get_contents("/var/www/php_exp/doug.csv");
for ($x = 0; $x < $max; $x++) {
	echo "<p><span style='font-size: 8px;'>" . $contents . "</span></p>\n";
	echo "<p>OB Length: " . ob_get_length() . "</p>\n";
	echo "<p>OB Status: <br>";
	var_dump(ob_get_status());
	echo "</p>\n";
}
ob_end_flush();
echo "<p>ob_flush()</p>\n";
echo "<p>OB Length: " . ob_get_length() . "</p>\n";
flush();
echo "<p>flush()</p>\n";
echo "<p>OB Length: " . ob_get_length() . "</p>\n";
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
