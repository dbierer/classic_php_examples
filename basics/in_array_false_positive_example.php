<?php
$a = array(1, 2, 3, 4, 5, TRUE);
//$a = array(1, 2, 3, 4, 5);
echo (in_array(3, $a)) ? "\nFound" : "\nNot Found";
// 'xyz' tests positive
echo (in_array('xyz', $a)) ? "\nFound" : "\nNot Found";
// need to set 3rd param to enforce 'strict' type checking
echo (in_array('xyz', $a, TRUE)) ? "\nFound" : "\nNot Found";
?>
