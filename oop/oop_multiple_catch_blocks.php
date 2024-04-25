<?php
try {
	// uncomment the line below: parser error / not caught
	// $pdo = new PDO()
	// uncomment the line below: ArgumentCountError
	// $pdo = new PDO();
	// uncomment the line below: PDOException
	// $pdo = new PDO('test.db');
} catch (PDOException $e) {
	echo __LINE__ . ':' . get_class($e);
	echo $e->getMessage();
} catch (Exception $e) {
	echo __LINE__ . ':' . get_class($e);
	echo $e->getMessage();
} catch (Throwable $t) {
	echo __LINE__ . ':' . get_class($t);
	echo $t->getMessage();
}
