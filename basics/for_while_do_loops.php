<?php 
for ($i = 1; $i <=5; $i++) {
	echo "Hello: $i\n";
}
var_dump($i);
$i = 1;
while ($i <= 5) {
	echo "Hello: $i\n";
	$i++;
}
var_dump($i);
$i = 0;
do {
	$i++;
	echo "Hello: $i\n";
} while ($i < 5);
var_dump($i);
?>