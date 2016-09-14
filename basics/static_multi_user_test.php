<?php
function counter() {
	static $count = 1000;
	echo " " . $count++;
}
for($x = 0; $x < 10000; $x++) {
	counter();
}
?>