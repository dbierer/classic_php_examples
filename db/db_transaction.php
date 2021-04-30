<?php 
/**
 * Comment on the program
 * @param string $test
 * @return boolean $result
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>PDO Transaction Test</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.16" />
</head>
<body>
<h1>PDO Transaction Test</h1>
<form name="TransTest" method=GET>
<br><b>Start Test: </b><input type=submit name="OK" value="Start" />
<br><b>Kill Table: </b><input type=submit name="kill" value="Kill" />
</form>
<?php
try {
	// Create database connection
	$mysql_host = "127.0.0.1";
	$mysql_database = "zend";
	$mysql_user = "zend";
	$mysql_password = "password";
	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database";
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
	echo $e->getMessage();
}
if (isset($_GET['kill'])) {
	$stmt = $dbh->prepare('DELETE FROM test;');
	$stmt->execute();	
} elseif (isset($_GET['OK'])) {
	$stmt = $dbh->prepare('INSERT INTO test SET test_key = ?, test_value = ?;');
	$waiting = true; // Set a loop condition to test
	$count = 100;
	while($waiting && $count > 0) {
	    try {
	        $dbh->beginTransaction();
	        for($i=0; $i < 10; $i++) {
				// Fake Data
				$a = (int) rand(1,999999);
				$b = date("d-m-Y H:i:s", time());
				// Execute instruction
				$stmt->bindValue(1, $a, PDO::PARAM_INT);
				$stmt->bindValue(2, $b, PDO::PARAM_STR);
				$stmt->execute();
	            sleep(1);		// arbitrary delay ... not needed in most cases
	        }
	        $dbh->commit();
	        $waiting = false;
	    } catch(Exception $e) {
            $dbh->rollBack();
            echo "<br>" . $e->getMessage();
	        $waiting = false;
	    }
	}
	$stmt = $dbh->prepare('SELECT COUNT(*) FROM test');
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_NUM);
	echo "<p><b>Number of Rows: </b>";
	foreach ($result as $item) {
		echo $item . "&nbsp;";
	}
	echo "</p>\n";
}
?>
</body>
</html>
