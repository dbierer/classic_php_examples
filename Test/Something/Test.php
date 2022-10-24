<?php
namespace Test\Something;

use ArrayIterator;
use Test\Something\Whatever;
class Test
{
	public function getIterator(array $arr)
	{
		return new ArrayIterator($arr);
	}
}
