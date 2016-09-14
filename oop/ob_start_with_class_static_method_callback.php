<?php
// create a static method to be used as a callback
class OutputWrapper {
	public static function callback($buffer)
	{
		return strtoupper($buffer);
	}
}
ob_start('OutputWrapper::callback');
echo 'This is a test';
ob_end_flush();
