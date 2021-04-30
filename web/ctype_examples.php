<?php
$data = ['123 ABC', 'ABC', '123456', 'Hello World', '(*(((&$$##@@'];

function alnumWithSpace($item)
{
	return ctype_alnum(str_replace(' ', '', $item));
}

foreach ($data as $item) {
	echo $item . ' : ';
	echo (ctype_alnum($item)) ? ' ALNUM ' : '';
	echo (ctype_alpha($item)) ? ' ALPHA ' : '';
	echo (ctype_digit($item)) ? ' DIGITS ' : '';
	echo (alnumWithSpace($item)) ? ' ALNUM+SPACE ' : '';
	echo PHP_EOL;
}
