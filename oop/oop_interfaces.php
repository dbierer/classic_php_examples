<?php
interface FileHandler {
	// Reads file
	// Inputs: (string) $filename
	function read ($filename);
	// Returns all lines in the file containing $item
	// Inputs: (string) $filename, (string) $item
	function query ($filename,$item);
	// Echos array line by line
	// Inputs: (array) $input
	function lineout ($input);
}

class FileReader implements FileHandler {
	function read ($fn) {
		if (file_exists($fn)) {
			$contents = file($fn);
		} else {
			$contents = array();
		}
		return $contents;
	}
	function query ($fn, $what) {
		if (file_exists($fn)) {
			if ($fh = fopen($fn,"r")) {
				while($line = fgets($fh)) {
					if (stripos($line,$what) !== FALSE) {
						$contents[] = $line;
					}
				}
				fclose($fh);
			}
		} else {
			$contents = "";
		}
		return $contents;
	}
	function lineout ($input) {
		foreach ($input as $line) {
			echo "<br>";
			if (is_array($line)) {
				foreach ($line as $item) {
					echo $item . "\n";
					echo "\n";
				}
			} else {
				echo $line . "\n";
				echo "\n";
			}
		}
		echo "<p>&nbsp;</p>\n";
	}
}

class CSVFileReader extends FileReader {
	function read ($fn) {
		$contents = array();
		if (file_exists($fn)) {
			if ($fh = fopen($fn,"r")) {
				while($line = fgetcsv($fh)) {
					$contents[] = $line;
				}
				fclose($fh);
			}
		} else {
			$contents = "";
		}
		return $contents;
	}
}

$a = new FileReader();
$result = $a->read("gettysburg.txt");
$a->lineout($result);

$b = new CSVFileReader();
$query = $b->query("doug.csv","Box");
$b->lineout($query);

?>