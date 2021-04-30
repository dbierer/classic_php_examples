`<?php
// Parses the UDEV log
/*
* Here's a UDEV entry:
UDEV  [1242956114.669421] add      /bus/acpi/drivers/fan (drivers)
UDEV_LOG=3
ACTION=add
DEVPATH=/bus/acpi/drivers/fan
SUBSYSTEM=drivers
SEQNUM=1913
UDEVD_EVENT=1
* 
* */

// Initialize variables
$action 	= "";
$mtime 		= 0;
$item 		= "";
$category 	= "";

// Identify filename of log
$log 		= "/var/log/udev";

// Read file into an array
$contents 	= file($log);

// UDEV pattern
$pattern 	= "%s  [%f] add      %s (%s)";

// Parse through file looking for UDEV entries
foreach ( $contents as $line ) {
	// Check for lines which start with "UDEV"
	if ( substr($line, 0, 5) == "UDEV ") {
		// Read one line using format $pattern
		sscanf($line, $pattern, $action, $mtime, $item, $category);
		$event[] = array($mtime, $item, $category);
	}
}

// Sort the entries
sort($event);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>UDEV Log Parser</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<h1>UDEV Log Parser</h1>
<table>
<?php 
// Present results
foreach ( $event as $value ) {
	// Separate microseconds from epochal seconds 
	list($usec, $msec) = explode(".", $value[0]);
	// Format human readable date 
	$when = date("Y-m-d H:i:s", $usec) . ":$msec";
	// Only display if there is a UDEV event
	if ($value[1]) {
		echo "<tr><td>" . $when . "</td>";
		echo "<td>" . $value[1] . "</td>";
		// Shorten the output string by 1 
		// to correct for sscanf parsing error
		echo "<td>" . substr($value[2],0,-1) . "</td></tr>\n";
	}
}
?>
</table>
</body>
</html>
