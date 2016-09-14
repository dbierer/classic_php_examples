<?php
function convert($array)
{
	$array[0] =  ($array[0] * ($array[1] / 100)) + $array[0];
	return $array;
}
$name = array(223.34,18);
list($cost, $percent) = convert($name);
echo "\n1: $cost";
list($a,$b) = array('a'=>1,'b'=>2,'c'=>3);
echo "\n2: $a $b";
list($a,$b) = array(1=>1,2,3);
echo "\n3: $a $b";
list($a,$b) = array(1,2,3);
echo "\n4: $a $b";
list($a,$b,$c,$d) = array(1,2,3);
echo "\n4: $a $b $c $d";
list($a,$b) = array(1);
echo "\n5: $a $b";
list($a,$b) = array(array(1,2,3), array(1,2,3));
echo "\n6: $a $b";
?>
