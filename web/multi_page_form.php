<?php
session_start();
error_reporting(E_ALL^E_NOTICE);
// Pull stuff in user input form
$page = (isset($_POST['page'])) ? (int) $_POST['page'] : 1;
if (isset($_POST["item"][$page][1])) {
	$item[$page][1] = htmlspecialchars($_POST["item"][$page][1]);
	$item[$page][2] = htmlspecialchars($_POST["item"][$page][2]);
	$_SESSION['item'][$page][1] = $item[$page][1];
	$_SESSION['item'][$page][2] = $item[$page][2];
}
// Pull stuff in from session
for ($x = 1; $x <= 3; $x++) {
	for ($y = 1; $y <= 2; $y++) {
		$item[$x][$y] = $_SESSION['item'][$x][$y];
	}
}
// Determine next page to navigate to
$next = 1;
if (isset($_POST['page3'])) {
	$next = 3;
} elseif (isset($_POST['page2'])) {
	$next = 2;
} else {
	$next = 1;
}
// Include new page
$new = sprintf("page%d.phtml",$next);
if (file_exists($new)) {
	include $new;
} else {
	echo "Page Not Found!";
}
echo "<table><tr><td valign='top'>\n";
echo "<pre>";
echo "<h2>POST</h2>\n";
var_dump($_POST);
echo "</pre></td><td valign='top'><pre>";
echo "<h2>SESSION</h2>\n";
var_dump($_SESSION);
echo "</pre></td></tr></table>\n";
?>
