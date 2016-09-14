<?php
// How to reference a class constant
class Test {
	const ABC = 'xyz';
}

$a = new Test();
echo $a::ABC;
echo PHP_EOL;
echo Test::ABC;