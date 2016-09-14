<?php
$a = array(1,2,3,4,5);
$it = new ArrayIterator($a);
$it->append(6);
foreach($it as $key => $value) {
	echo "$key:$value\n";
}

class Test extends ArrayObject
{
	public $name = 'DOUG';
	public function xyz()
	{
		
	}
}
$obj = new Test($a);
$obj[] = 7;
echo $obj[3];
var_dump($obj);
