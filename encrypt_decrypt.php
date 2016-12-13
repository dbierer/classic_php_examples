<?php
// NOTE: designed to run on PHP 7
session_start();
// init vars
define('IV_LENGTH', 16);
define('KEY_LENGTH', 32);
$plain  = $_POST['plain']  ?? 'Nothing to encrypt';
$cipher = $_POST['cipher'] ?? 'Nothing to decrypt';
$key    = $_POST['key']    ?? $_SESSION['key'] ?? substr(bin2hex(md5(rand(0,999999))), 0, KEY_LENGTH);
$iv     = $_POST['iv']     ?? $_SESSION['iv']  ?? substr(bin2hex(md5(rand(0,999999))), 0, IV_LENGTH);
// iv must be 16 bytes, zero padded
if (strlen($iv) < IV_LENGTH) {
    $iv = str_pad($iv, IV_LENGTH, ' ');
}
// store key / iv in session
$_SESSION['key'] = $key;
$_SESSION['iv']  = $iv;
// perform encrypt / decrypt
$encrypted = base64_encode(openssl_encrypt($plain, 'aes-256-ctr', $key, 0, substr($iv, 0, 16)));
$decrypted = openssl_decrypt(base64_decode($cipher), 'aes-256-ctr', $key, 0, substr($iv, 0, 16));
?>
<!DOCTYPE html>
<head>
	<title>OpenSSL Encrypt/Decrypt</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<form method="post">
<table>
    <tr><th>Key</th><td><input type="text" name="key" value="<?= $key; ?>"/></td></tr>
    <tr><th>IV</th><td><input type="text" name="iv" value="<?= $iv; ?>" /></td></tr>
    <tr><th>Text to Encrypt</th><td><input type="text" name="plain" /></td></tr>
    <tr><th>Text to Decrypt</th><td><input type="text" name="cipher" /></td></tr>
    <tr><th><input type="submit" /></th><td>&nbsp;</td></tr>
</table>
</form>

<hr>
<h1>Encrypted Results</h1>
<pre><?= $encrypted; ?></pre>
<hr>
<h1>Decrypted Results</h1>
<pre><?= $decrypted; ?></pre>

</body>
</html>
