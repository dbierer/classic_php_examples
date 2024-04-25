<?php

try {
	$pdo = new PDO()
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
