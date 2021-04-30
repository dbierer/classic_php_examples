<?php

// Initialize variables
$error = "";
$output = "";
$sql = "";
$cols = array();
$dbs = array();

// Select database
$mysql_host = "localhost";
$mysql_database = "mysql";
$mysql_user = "";
$mysql_password = "";
if ( isset($_POST['use']) ) {
	$mysql_database = isset($_POST['dbs']) ? $_POST['dbs'] : "mysql";
}

// Open connection
try {
	// Database connect -- use one of the two statements below
	//$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database;
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/usr/local/Zend/Platform/MySQL/var/mysql.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
	// Load array with database names
	$sql = "SHOW DATABASES;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	$line = $sth->fetch(PDO::FETCH_NUM);
	foreach ( $line as $item) {
		$dbs[] = $item;
	}
} catch (PDOException $e) {
    $error = 'Connection failed: ' . $e->getMessage();
}

if ( isset($_POST['ok'])) {
	if ( isset($_POST['sql'])) {
		$raw = $_POST['sql'];
	}
	$sql = stripslashes($raw);
	$html = preg_replace("/\"/", "&quot;", $sql);
	$output .= "<br>" . $html;
	if ( $sth = $dbh->prepare($sql)) {
		if ( $sth->execute() ) {
			$output .= "<table border=1>\n";
			$line = $sth->fetch(PDO::FETCH_ASSOC);
			if ( $line ) {
				$output .= "<tr>";
				foreach($line as $key => $value ) {
					$output .= "<td>" . $key . "</td>";
				}
				$output .= "</tr>\n";
				$output .= "<tr>";
				foreach($line as $key => $value ) {
					$output .= "<td>" . $value . "</td>";
				}
				$output .= "</tr>\n";
				while ( $line = $sth->fetch(PDO::FETCH_NUM) ) {
					$output .= "<tr>";
					foreach ( $line as $item ) {
						$output .= "<td>" . $item . "</td>";
					}
					$output .= "</tr>\n";
				}
			} else {
				$output .= "<tr><td>NO RESULTS!</td></tr>\n";
			} 
			$output .= "</table>\n";
		} else {
			$error .= "<br>ERROR: Unable to execute SQL";
		}
	} else {
		$error = '<br> ERROR: Prepare failed';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SQL</title>
</head>
<body>
<h1>SQL</h1>
<p>
<form name="SQL" method=POST>
<br><input name="sql" size=70 maxlength=255 value="<?php echo @$html; ?>" />
<br><input name="ok" type=submit value="OK" />
<br>Choose a Database
<select name="dbs">
<?php
foreach ( $dbs as $item ) {
	echo "<option>" . $item . "</option>\n";
} 
?>
</select>
<input name="use" type=submit value="use" />
</table>
</form>
<p>
<?php
echo $output;
echo $error;
phpinfo(INFO_VARIABLES);
var_dump($_SESSION);
?>
</body>
</html>
