<?php
function test($count = 1)
{
	static $count = 1;
	echo $count++ . ' ';
	test($count);
}
test();
?>