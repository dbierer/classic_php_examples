<?php
// on first glance, the following appears to output 'true'
echo (true?'TRUE':false?'T':'F');
echo "\n";

// however, the actual output of the above is 'T'
// this is because ternary expressions are evaluated from left to right

// the following is a more obvious version of the same code as above
echo ((true ? 'TRUE' : 'FALSE') ? 'T' : 'F');

// here, you can see that the first expression is evaluated to 'true', which
// in turn evaluates to (bool)true, thus returning the true branch of the
// second ternary expression.

// NOTE: PHP 5.3 has added a new ternary operation "?:"

?>
