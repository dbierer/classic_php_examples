<?php 
// M2Ex4 -- arrays
$array = array(
	1 => range(1,4),		// range(1,4) = array(1, 2, 3, 4)
	2 => array('a', 'b', 'c'),
	3 => array(1, 2, 3, 4, 5, 6),
	4 => range(1,5),
	5 => array('d', 'e', 'f'),
	6 => range(1,4),
	7 => range(1,7)
);
/* output should look like this:
 1: 1, 2, 3, 4
 3: 1, 2, 3, 4, 5, 6
 5: d, e, f
 etc.
*/

?>
