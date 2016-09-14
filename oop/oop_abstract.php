<?php
abstract class ODate {

	public function DMY () {
		return date("d-m-Y", time());
	}
	public function MDY () {
		return date("m/d/Y", time());
	}
	public function full () {
		return date("l, F d, Y", time());
	}
	abstract public function custom();
}

class MDate extends ODate {
	public function timeout($opt) {
		switch ($opt) {
			case 1: 
				echo $this->DMY();
				break;
			case 2:
				echo $this->MDY();
				break;
			default:
				echo $this->full();
		}
		echo "\n";
	}
//	public function custom()
//	{
//		return 'custom output';
//	}
}

$a = new MDate();
echo $a->timeout(1);
echo $a->timeout(2);
echo $a->timeout(3);
?>