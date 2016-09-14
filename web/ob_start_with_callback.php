<?php
function callback($buffer)
{
	return strtoupper($buffer);
}
ob_start('callback');
echo 'This is a test';
ob_end_flush();
