<?php
$start = "/workspace/zblogapp/application/*";
function look($start) {
	$list = glob($start);
//	var_dump($list);
	foreach ($list as $item) {
		if (is_file($item)) {
			$size = filesize($item);
			$lines = count(file($item));
			$item = basename($item);
			printf("%8d \t: %8d \t: %s\n",$size,$lines,$item);
		} else {
			printf("%-8s \t: %-8s \t: %s\n","Size","Lines",$item);
			$item .= "/*";
			look($item);
		}
	}
}
look($start);
?>