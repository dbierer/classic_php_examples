<?php
$a = "TEST\n";
$b = "a";
echo $$b;

function foo() {
	echo "FOO\n";
}
function bar() {
	echo "BAR\n";
}
function bat() {
	echo "BAT\n";
}
$func = array('foo','bar','bat');
foreach ($func as $run) {
	$run();
}
?>
