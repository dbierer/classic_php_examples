<?php
// starting code
// NOTE: the range($start, $stop) command returns an array of values between $start and $stop
$array = array(
				1 => range(1, 4),
				2 => array(1, 5, 7, 9, 11),
				3 => range(1, 6),
				4 => array('a', 'b', 'c', 'd', 'e', 'f'),
				5 => range(1, 4),
				6 => range(1, 5),
				7 => range(1, 6),
				8 => array('a', 'b', 'c', 'd', 'e', 'f'),
				9 => range(1, 3),
				);

// solution:
/* desired output:
 * 1: 1, 2, 3, 4
 * 3: 1, 2, 3, 4, 5, 6
 * ...
 * 9: 1, 2, 3
 */
/*
for ( $x=1; $x<count($array); $x+=2) {    
	echo $x . ": ";    
	for ( $y = 0; $y < count($array[$x]); $y++) {        
		if ( is_int($array[$x]) ) {            
			echo $array[$x] . ",";        
		}        
	}
}
*/
				

foreach ($array as $key=>$newArr) {    
	if (($key % 2) == 1) {
		$output = '';
		/*
		foreach ($newArr as $outputValue) {        
			$output .= ", $outputValue ";    
		}
		*/
		$output = implode(', ', $newArr);
		echo $key . ': ' . $output . PHP_EOL;
	}
}

?>