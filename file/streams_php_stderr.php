<?php
// 2011-07-13 DB: uses streams to write to the OS error log
date_default_timezone_set('America/Los_Angeles');
file_put_contents('php://stderr', date('Y-m-d H:i:s') . ': TEST');
?>
