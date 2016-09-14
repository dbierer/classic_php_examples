<?php
// assign initial values
$arrayIt = new ArrayIterator(['k' => 'Kiwi', 'c' => 'Cherry', 'b' => 'Banana',]);

// add a key/value pair
$arrayIt->offsetSet('a', 'Apple');

echo $arrayIt->current() . PHP_EOL;
$arrayIt->next();
echo $arrayIt->current() . PHP_EOL;
$arrayIt->rewind();
echo $arrayIt->current() . PHP_EOL;

var_dump($arrayIt->getArrayCopy());

$arrayIt->asort();

var_dump($arrayIt->getArrayCopy());
