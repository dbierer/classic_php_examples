<?php
$a = "AAAAAA";
$b = "BBBBBB";

echo "\nA = $a - B = $b\n";

no_change( $a, $b );

echo "\nA = $a - B = $b\n";

change( $a, $b );

echo "\nA = $a - B = $b\n";

function no_change ( $input1, $input2 ) {
	$temp = $input1;
	$input1 = $input2;
	$input2 = $temp;
	echo "\nINPUT1 = $input1 - INPUT2 = $input2\n";
}

function change ( &$input1, &$input2 ) {
	$temp = $input1;
	$input1 = $input2;
	$input2 = $temp;
	echo "\nINPUT1 = $input1 - INPUT2 = $input2\n";
}


?>