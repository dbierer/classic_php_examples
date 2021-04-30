<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$text = 'This is a "SUPER SECRET" string with £$%^&* characters';
$key  = substr(bin2hex(md5(rand(0,999999))), 0, 32);
$iv   = substr(bin2hex(md5(rand(0,999999))), 0, 32);

$cipher = base64_encode(openssl_encrypt($text, 'aes-256-ctr', $key, 0, substr($iv, 0, 16)));
$back   = openssl_decrypt(base64_decode($cipher), 'aes-256-ctr', $key, 0, substr($iv, 0, 16));
echo "\nText: \n$text\n";
echo "\nEncrypted using openssl_encrypt():\n$cipher\n";
echo "\nDecrypted using openssl_decrypt():\n$back\n";

//echo "\n----------------------------------------------------\n";
//echo "This gives you a list of cipher methods supported on your computer";
//echo "\n----------------------------------------------------\n";
//echo implode(' ', openssl_get_cipher_methods());
