<?php
// REF: http://php.net/manual/en/function.iterator-to-array.php
function getNumLines(SplFileInfo $fi)
{
	$count = 0;
	$fo = $fi->openFile('r');
	while (!$fo->eof()) {
		$a = $fo->fgets();
		$count++;
	}
	return $count;
}

$path = realpath(__DIR__ . '/../../php_sec');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), 
										 RecursiveIteratorIterator::SELF_FIRST);
$rows = '';
$count = 0;
foreach($objects as $name => $object){
	$color = ($count++ & 1) ? '#FFFFEE' : '#FFFFDD';
	if ($object->isDir()) {
		$rows .= sprintf('<tr bgcolor="%s"><td colspan=4>%s</td></tr>' . PHP_EOL, $color, $name);
	} else {
		$rows .= sprintf('<tr bgcolor="%s"><td width="10px;">&nbsp;</td><td>%s</td><td>%s</td><td>%d</td></tr>' . PHP_EOL, 
						  $color, $object->getBasename(), $object->getSize(), getNumLines($object));
	}
}
?>
<table>
<?php echo $rows; ?>
</table>