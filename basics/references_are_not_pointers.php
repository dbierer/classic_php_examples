<?php
// Demonstrates why PHP 'references' are not like "C" pointers
$a = 'aaaaaa';
$GLOBALS['b'] = 'bbbbbb';
$c = 'cccccc';

echo "\n";
echo "line 08 -- b = " . $GLOBALS['b'] . "\n";
echo "line 09 -- c = $c\n\n";

$GLOBALS['b'] =& $a; // $GLOBALS['b'] == 'aaaaaa'
foo($c); // the value of c will remain 'cccccc'

echo "\n";
echo "line 15 -- b = " . $GLOBALS['b'] . "\n";
echo "line 16 -- c = $c\n";
echo "line 17 -- b = $b\n";
echo "\nTo Notice: value of \$c is unchanged!\n";

function foo (&$var)  {
   	$var =& $GLOBALS['b']; //affects only 'var' copy
   	//$var = $GLOBALS['b']; //affects global 'var' copy
	echo "line 21 -- b = " . $GLOBALS['b'] . "\n";
	echo "line 22 -- var  = " . $var . "\n";
}
?>