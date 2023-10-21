<?php
$usage = 'Usage: php ' . basename(__FILE__) . ' FILENAME [PASSWORD] [IV] [TAG]' . PHP_EOL;

// change as needed; use openssl_get_cipher_methods() if unsure
$algo = 'aes-256-gcm';

// Grab inputs
$fn  = $argv[1] ?? '';
$pwd = $argv[2] ?? '';
$iv  = $argv[3] ?? '';
$tag = $argv[4] ?? '';

// other vars
$tgt_enc  = '';
$tgt_cred = '';

// bail if file not found
if (empty($fn) || !file_exists($fn)) {
    exit ('Unable to locate file: ' . $fn . PHP_EOL . $usage);
} else {
    $contents = file_get_contents($fn);
}

// create random password if none given
if (empty($pwd)) {
    $alpha = range(' ','z');
    for ($x = 0; $x < 12; $x++)
        $pwd .= $alpha[array_rand($alpha)];
}

// info func
$results = function($fn, $pwd, $iv, $tag, $tgt_enc = '', $tgt_cred = '') {
    $output = 'File:  ' . $fn . PHP_EOL
			. 'Pwd:   ' . base64_encode($pwd) . PHP_EOL
			. 'IV:    ' . base64_encode($iv) . PHP_EOL			. 'Tag:   ' . base64_encode($tag) . PHP_EOL;
	$output .= (!empty($tgt_enc)) ? 'Enc:   ' . $tgt_enc . PHP_EOL : '';
	$output .= (!empty($tgt_cred)) ? 'Creds: ' . $tgt_cred . PHP_EOL : '';
	return $output;
};

// if tag is present that means decrypt
if (empty($tag)) {
    $action = 'Encrypt';
    $ivlen  = openssl_cipher_iv_length($algo);
    $iv     = openssl_random_pseudo_bytes($ivlen);
    $text   = openssl_encrypt($contents, $algo, $pwd, iv:$iv, tag:$tag);
    $tgt_enc = $fn . '.enc';
    $tgt_cred = $fn . '.creds';
    file_put_contents($tgt_enc, $text);
    file_put_contents($tgt_cred, $results($fn, $pwd, $iv, $tag, $tgt_enc, $tgt_cred));
} else {
    $action = 'Decrypt';
    $text = openssl_decrypt($contents, $algo, base64_decode($pwd), iv:base64_decode($iv), tag:base64_decode($tag));
}

// results should be piped to a file if encrypting
echo $usage;
echo $action . PHP_EOL;
echo $results($fn, $pwd, $iv, $tag, $tgt_enc, $tgt_cred);
