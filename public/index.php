<?php
session_start();
$name = $_POST['name'] ?? $_SESSION['name'] ?? '';
$_SESSION['name'] = strip_tags($name);
?>
<form method="post">
	<input type="text" name="name" value="<?= htmlspecialchars($name) ?>" />
	<input type="submit" />
</form>
<?php phpinfo(INFO_VARIABLES); ?>