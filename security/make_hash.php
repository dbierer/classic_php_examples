<?php
// /libs/security_lib.php
function make_hash(string $pwd, string $type) {
    $salt = bin2hex(random_bytes(4));
    return match ($type) {
        'Standard DES' => crypt($pwd, 'rl'),
        'Extended DES' => crypt($pwd, '_J9..rasm'),
        'MD5'          => crypt($pwd, '$1$' . substr($salt, 0, 8) . '$'),
        'Blowfish'     => crypt($pwd, '$2a$07$' . substr($salt, 0, 32) . '$'),
        'SHA-256'      => crypt($pwd, '$5$rounds=5000$' . substr($salt, 0, 32) . '$'),
        'SHA-512'      => crypt($pwd, '$6$rounds=5000$' . substr($salt, 0, 32) . '$')
    };
}