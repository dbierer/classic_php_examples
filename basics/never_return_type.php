<?php
// NOTE: only works on PHP 8.1 and above
define('PHRASES', __DIR__ . '/../random_phrases.txt');
function eliza(string $fn) : never
{
    $phrases = file($fn);
    $name = readline("Hello, what's your name?\n");
    $fh = fopen('php://stdin', 'r');
    echo "Hello $name, how are you feeling today?\n";
    while (true) {
        $raw = fgets($fh);
        if (!empty($raw))
            echo $phrases[array_rand($phrases)];
    }
}
eliza(PHRASES);
