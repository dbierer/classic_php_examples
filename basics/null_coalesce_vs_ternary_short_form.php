<?php
$ex1 = NULL;
$ex2 = FALSE;
$ex3 = 'THREE';

echo __LINE__ . ':' . ($ex1 ?: $ex2) . PHP_EOL;
echo __LINE__ . ':' . ($ex1 ?: $ex3) . PHP_EOL;
echo __LINE__ . ':' . ($ex2 ?: $ex3) . PHP_EOL;
echo __LINE__ . ':' . ($ex1 ?? $ex2) . PHP_EOL;
echo __LINE__ . ':' . ($ex1 ?? $ex3) . PHP_EOL;
echo __LINE__ . ':' . ($ex2 ?? $ex3) . PHP_EOL;

/* Yields:
