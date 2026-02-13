<?php
function sanitize(mixed $val)
{
    $result = match (true) {
        is_string($val) => (fn($val) => trim(strip_tags($val))),
        is_float($val) => (fn($val) => (float) $val),
        is_int($val) => (fn($val) => (int) $val),
        is_object($val)  => (fn($val) => $val),
        default => (fn($val) => null),
    };
    return $result($val);
}

echo sanitize('<script>alert("TEST");</script>');
echo PHP_EOL;
echo sanitize(12345);
echo PHP_EOL;
echo sanitize(12345.789);
echo PHP_EOL;

