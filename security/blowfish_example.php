<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Blowfish Encryption Example</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<?php
set_include_path("./PEAR");
include "PEAR/Crypt/Blowfish.php";
//include_once "PEAR/Crypt/Blowfish.php";

function encrypt($contents, $key, $iv) { 
	$bf =& Crypt_Blowfish::factory('cbc');
	$bf->setKey($key, $iv);
	return $bf->encrypt($contents);
}

function decrypt($contents, $key, $iv) {
	$bf =& Crypt_Blowfish::factory('cbc');
	$bf->setKey($key, $iv);
	return $bf->decrypt($contents);
}

/* Read contents of test file  */
$contents = file_get_contents('gettysburg.txt');

/* Encrypt & Decrypt */
$iv = "abc123+=";
$key = "Some Secret Key";
$encrypted = encrypt($contents, $key, $iv);
$decrypted = decrypt($encrypted, $key, $iv);

/* Echo results */
echo "<h3>Encrypted Output</h3><hr />\n";
echo "<pre>$encrypted</pre>\n";
echo "<p></p>\n";
echo "<h3>Decrypted Output</h3><hr />\n";
echo "<pre>$decrypted</pre>\n";
?>
</pre>
</body>
</html>
