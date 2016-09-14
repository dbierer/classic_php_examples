<?php
function doSomething($string, array $array = null) 
{
	echo $string . PHP_EOL;
}

$a = array(1,2,3,4);
$b = NULL;
$c = new ArrayObject($a);

doSomething('array', $a);
doSomething('null', $b);
doSomething('object', $c);
