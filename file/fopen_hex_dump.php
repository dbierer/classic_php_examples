<?php 

// Initialize Variables
// i.e. /usr/local/zend/apache2/htdocs/phpstudy/chap6/index.php
$fn = $_SERVER["SCRIPT_FILENAME"];
// i.e. /phpstudy/chap6/index.php
$sn = $_SERVER["SCRIPT_NAME"];
// i.e. www.systemateka.com:10088
$host = $_SERVER["HTTP_HOST"];
// Instantiate class
$list = new ListFiles ( $fn, $sn, $host );
// Width
$list->width = 20;

class ListFiles {
	
	// Declare variables
	private $fn;
	private $dir;
	private $stem;
	private $base;
	public $script;
    public $back;
    public $width;
    	
	function __construct( $fn, $sn, $host ) {	
		// i.e. /usr/local/zend/apache2/htdocs/phpstudy/chap6/
		$this->dir 	= dirname($fn) . DIRECTORY_SEPARATOR;
		// i.e. /phpstudy/chap6/
		$this->stem = dirname($sn) . DIRECTORY_SEPARATOR;
		// i.e. http://www.systemateka.com:10088
		$this->base = "http://" . $host;
		// i.e. www.systemateka.com:10088/phpstudy/chap6/index.php
		$this->script = $this->base . $sn;
		// i.e. www.systemateka.com:10088/phpstudy/chap6/../
		$this->back	= $this->base . $this->stem . ".." . DIRECTORY_SEPARATOR;
	}
	
	function show ( ) {
		// Scan through directory
		foreach (new DirectoryIterator($this->dir) as $fileInfo) {
			// Weed out "." and ".."
			if($fileInfo->isDot()) { 
		    	continue; 
		    } else {
				$f = $fileInfo->getFilename();
				print "<tr><th>$f</th>";
				print '<td><input type=radio name="View" value="' . $f . '"></td>';
				print '</tr>' . PHP_EOL;
			}
		}
	}
	
	function view ( $file ) {
		$f = $this->dir . $file;
		print "<tr><td colspan=3><b>$f</b></td></tr>";
		if ( file_exists ( $f ) ) {
			print "<tr><td colspan=3>";
			// Set up subtable
			print "<table>\n";
			// Open for binary read
			$fh = fopen($f, "rb");
			// Scan until EOF
			while(!feof($fh)) {
				// Read in $this->width characters at a time
				$line = fread($fh, $this->width);
				// Parse through string
				$max = strlen($line);
				for($x = 0; $x < $this->width; $x++) {
					// Check to see if string length exceeded
					if ( $x < $max ) {
						// Extract single character
						$a = substr($line,$x,1);
						// Check to see if printable
						if (ctype_print($a)) {
							print "<th>" . $a . "</th>";
						// If not then print a "."
						} else {
							print "<th>.</th>";
						}
						// Print ASCII code in hex
						print "<td>: " . dechex(ord($a)) . "</td>";
					} else {
						print "<td>&nbsp;</td></td>:&nbsp;.</td>";
					}
				}
				// Next row
				print "</tr>\n";
			}
			// Close file and end table
			fclose($fh);
			print "</table></td></tr>" . PHP_EOL;
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Index</title>
<style type="text/css">
td {
	border: none;
	font: 10pt helvetica, sans-serif;
	text-align: left;
	color: gray;
	}
th {
	border: none;
	font: bold 10pt helvetica, sans-serif;
	text-align: right;
	color: blue;
	}
</style>
</head>
<body>
<h1>Hex Dump</h1>
<hr>
<form name="Index" method=POST>
<table>
<?php
if ( isset ($_REQUEST['View']) ) {
	$list->view ( $_REQUEST['View'] );
} else {
	$list->show();
}
?>
</table>
<input type=submit name="OK" value="Dump" />
</form>
<br><a href="hex_dump.php">BACK</a>
<br><a href="index.php">Index</a>
</body>
</html>
