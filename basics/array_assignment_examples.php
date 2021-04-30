<?php 
// array() produces an array; numerically based
echo '<pre>';
$a = array('a', 'b', 'c');
// php 5.4
// $a = ['a', 'b', 'c'];
var_dump($a);
// produced numerical index, next value; note: could also use array_push
$b[] = 'a';
$b[] = 'b';
$b[] = 'c';
var_dump($b);
// produced numerical index, starts with 3
$c[3] = 'a';
$c[] = 'b';
$c[] = 'c';
var_dump($c);
// produced numerical index, starts with 3
$g[3] = 'a';
$g[2] = 'b';
$g[5] = 'c';
$g[]  = 'd';
var_dump($g);
// array() produces an associative array; string index
$d = array('aa' => 'a', 'bb' => 'b', 'cc' => 'c');
var_dump($d);
$d4 = ['aa' => 'a', 'bb' => 'b', 'cc' => 'c'];
var_dump($d4);
// produced associative array
$e['aa'] = 'a';
$e['bb'] = 'b';
$e['cc'] = 'c';
var_dump($e);
echo PHP_EOL;
if (is_array($e)) {
	echo '$e is an Array';
}
$f = array($a, $b, $c, $d);
var_dump($f);
echo PHP_EOL;
// echo the 1st value of the 2nd array in $f
echo $f[1][0];
echo PHP_EOL;
// mixed indices
$h['aa'] = 2; 
$h[] 	 = 3;
var_dump($h);
echo PHP_EOL;
// serialize $f for storage
$s = serialize($f);
echo $s;
echo PHP_EOL;
echo PHP_EOL;
echo '</pre>';
