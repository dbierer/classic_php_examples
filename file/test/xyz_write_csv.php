<?php
// Initialize Variables
// i.e. /usr/local/zend/apache2/htdocs/phpstudy/chap6/index.php
$fn = $_SERVER["SCRIPT_FILENAME"];
// i.e. /phpstudy/chap6/index.php
$sn = $_SERVER["SCRIPT_NAME"];
// i.e. www.systemateka.com:10088
$host = $_SERVER["HTTP_HOST"];

// Instantiate class
$csv = new WriteCSV ( $fn, $sn, $host, "demo.csv" );

// Capture input
$input = array();
if (isset($_POST['ADD'])) {
	$input[] = isset($_POST['name']) ? strip_tags($_POST['name']) : "N/A";
	$input[] = isset($_POST['address']) ? strip_tags($_POST['address']) : "N/A";
	$input[] = isset($_POST['city']) ? strip_tags($_POST['city']) : "N/A";
	$input[] = isset($_POST['postcode']) ? strip_tags($_POST['postcode']) : "N/A";
	$input[] = isset($_POST['country']) ? strip_tags($_POST['country']) : "N/A";
	$input[] = isset($_POST['phone']) ? strip_tags($_POST['phone']) : "N/A";
	$csv->add($input);
}

class WriteCSV {
	
	// Declare variables
	private $dir;
	private $stem;
	private $base;
	public $script;
    public $filename;
    public $error;
    	
	function __construct( $fn, $sn, $host, $data_file ) {	
		// i.e. /usr/local/zend/apache2/htdocs/phpstudy/chap6/
		$this->dir 	= dirname($fn);
		// i.e. /phpstudy/chap6/
		$this->stem = substr ( $sn, 0, strrpos ($sn, DIRECTORY_SEPARATOR ) + 1);
		// i.e. http://www.systemateka.com:10088
		$this->base = "http://" . $host;
		// i.e. www.systemateka.com:10088/phpstudy/chap6/index.php
		$this->script = $this->base . $sn;
		// i.e. /usr/local/zend/apache2/htdocs/phpstudy/chap6/demo.csv
		$this->filename = $this->dir . DIRECTORY_SEPARATOR . $data_file;
	}

	// Add array $data to CSV file
	function add ($data) {
		if ($fh = fopen($this->filename, "a+")) {
			fputcsv($fh, $data);
			fclose($fh);
		} else {
			$this->error .= "Unable to write to " . $this->filename;
		}
	}
	
	// Display contents of CSV file
	function display() {
		// Does the file exist?
		if ( file_exists($this->filename)) {
			// Open for read
			$fh = fopen($this->filename, "r");
			// Loop through each line
			while(!feof($fh)) {
				// Get a row of CSV data
				$row = fgetcsv($fh);
				if ($row && is_array($row)) {
					// Print it out as a table row
					print "<tr>";
					foreach($row as $cell) {
						print "<td>$cell</td>";
					}
					print "</tr>\n";
				}
			}
			fclose($fh);
		} else {
			$this->error .= "Unable to open " . $this->filename;
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
<h1>Write CSV</h1>
<hr>
<form name="WriteCSV" method=POST action="write_csv.php">
<table>
<tr><th>Name</th><td><input type=text name="name" size=40 maxlength=64 /></td></tr>
<tr><th>Address</th><td><input type=text name="address" size=60 maxlength=255 /></td></tr>
<tr><th>City</th><td><input type=text name="city" size=40 maxlength=64 /></td></tr>
<tr><th>Postcode</th><td><input type=text name="postcode" size=20 maxlength=20 /></td></tr>
<tr><th>Country Code</th><td><input type=text name="country" size=2 maxlength=2 /></td></tr>
<tr><th>Phone</th><td><input type=text name="phone" size=16 maxlength=16 /></td></tr>
<tr><td colspan=2><input type=submit name="ADD" value="ADD" />
</table>
<?php
if (file_exists($csv->filename)) {
	echo "<table>\n";
	echo "<tr><th>Name</th><th>Address</th><th>City</th><th>Postcode</th><th>Country</th><th>Phone</th></tr>\n";
	$csv->display();
	echo "</table>\n";
}
?>
</table>
</form>
<?php
	echo @$csv->error;
	phpinfo(INFO_VARIABLES);
?>
<a href="index.php">BACK</a>
</body>
</html>
