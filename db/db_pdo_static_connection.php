<?php
class Database
{		
	public static $connection;
	
	public static function setConnection($host = NULL, $database = NULL, $user = NULL, $password = NULL)
	{
		if (!self::$connection) {
			// Open connection
			try {
				// Database connect -- use one of the two statements below
				// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database";
				$dsn = 	"mysql:host=" . $host . ";dbname=" . $database . ";unix_socket=/var/run/mysqld/mysqld.sock";
				self::$connection = new PDO($dsn, $user, $password);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}				
		}
	}
	public static function getConnection()
	{
		return self::$connection;
	}
}

Database::setConnection('localhost', 'zend', 'zend', 'password');
$pdo = Database::getConnection();

// SQL prepare
$sql = "SELECT * FROM products AS p";
$sth = $pdo->prepare($sql);
// Execute
$sth->execute();
// Fetch results
echo "<table border=1>";
// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
while ($row = $sth->fetch(PDO::FETCH_OBJ)) {
	$val = var_export($row, TRUE);
	echo "<tr><td>$val</td></tr>\n";
}
echo "</table>\n";


?>
