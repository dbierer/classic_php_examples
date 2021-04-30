<?php
function withSpace() {
	$count = 100000;
	$t = microtime(true);
	for ($i=0; $i < $count; $i++) {
		if ($i == -1) {
		} else if ($i == -2) {
		} else if ($i == -3) {
		}
	}
	return microtime(true)-$t;
}
function noSpace() {
	$count = 100000;
	$t = microtime(true);
	for ($i=0; $i < $count; $i++) {
		if ($i == -1) {
		} elseif ($i == -2) {
		} elseif ($i == -3) {
		}
	}
	return microtime(true)-$t;
}
$result = array();
for ($x = 0; $x < 100; $x++) {
	$a = rand(1,100);
	if ($a % 2) {
		$result['noSpace'][] = noSpace();
	} else {
		$result['withSpace'][] = withSpace();
	}
}

?>
<html>
<body>
<table>
<tr><th>elseif</th><th>else if</th></tr>
<tr>
<td><?php echo @implode("<br />",$result['noSpace']); ?></td>
<td><?php echo @implode("<br />",$result['withSpace']); ?></td>
</tr>
</table>
</body>
</html>
