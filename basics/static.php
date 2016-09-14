<?php
function counter1() {
	static $count = 10;
	echo $count++ . "\n";
}
function counter2() {
	static $count = 20;
	echo ++$count . "\n";
}
function counter3() {
	$count = 30;
	echo $count++ . "\n";
}

counter1();
counter1();
counter1();

counter2();
counter2();
counter2();

counter3();
counter3();
counter3();

counter1();

counter2();

counter3();

?>