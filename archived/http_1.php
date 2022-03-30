<?php
/*
 *      http.php
 *      
 */
if (isset($_GET['OK'])) {
	$method = $_GET['method'];
	$url = $_GET['url'];
	switch ($method) {
		case "GET":
			$header = "GET " . $url . " HTTP/1.1";
	}
	header($header);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>HTTP</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>

<body>
<h1>HTTP Test</h1>
<form name="HTTP_Test" action=GET>
<table>
	<tr>
		<th>Method</th>
		<td>
			<select name="method">
				<option>HEAD</option>
				<option>GET</option>
				<option>POST</option>
				<option>PUT</option>
				<option>DELETE</option>
				<option>TRACE</option>
				<option>OPTIONS</option>
				<option>CONNECT</option>
			</select>
		</td>
	</tr>
	<tr>
		<th>URL</th>
		<td>
			<input name="url" type=text size=60 maxlength=255 />
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<input type=submit name="OK" value="OK" />
		</td>
	</tr>
</table>
</form>
</body>
</html>
