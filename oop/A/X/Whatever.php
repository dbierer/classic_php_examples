<?php
// needs to go into ./A/X/Whatever.php
namespace A\X;

class Whatever
{
	public $abc = 'ABC';
	public function getName()
	{
		return __CLASS__;
	}
}
