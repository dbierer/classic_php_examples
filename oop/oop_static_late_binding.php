<?php
class Dad {
	protected static $name = "Ralph";
	public function getName() {
		// Comment out line 6, uncomment 7, and re-run
//		echo self::$name;
		echo static::$name;
	}
}
class Kid extends Dad {
	protected static $name = "Doug";
}
Kid::getName();
?>
