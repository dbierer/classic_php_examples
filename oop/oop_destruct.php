<?php
date_default_timezone_set('Europe/Berlin');
session_start();

class LogFile {

	public $fh;
	private $test;
	public $fn;
	
	function __construct ( $fn ) {
		$this->fn = $fn;
		if ($this->fh = fopen($fn,"a+")) {
			echo "\nLog File Open: $fn\n";
		} else {
			echo "\nError in Open: $fn\n";
		}
	}
	
	function __destruct () {
		fclose($this->fh);
		echo "\nLog File Closed " . $this->fn . "\n";
	}
	
	function write ($something) {
		fputs($this->fh,$something . "\n");
	}
	
	function read () {
		echo "\n";
		rewind($this->fh);
		while (!feof($this->fh)) {
			$line = fgets($this->fh);
			echo $line;
		}
	}	
}

$log = new LogFile("aa.log");
$log->write(date("Y-m-d H:i:s",time()));
$log->read();
// __destruct()  is called if: 
// object is unset = out of scope
$_SESSION['log'] = $log;
//$log = "";
//unset($log);
// end of script

function test() {
	$log2 = new LogFile("bb.log");
	$log2->write(date("Y-m-d H:i:s",time()));
	$log2->read();
}
test();
test();

// Overwrites with new instance
//$log = new LogFile("b.log");
echo "\n Last Line ------------ \n";
?>
