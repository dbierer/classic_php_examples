<?php
error_reporting(E_ALL|E_STRICT);
function opt ( $not_optional, $optional = "Optional", $third = '') {
	echo "<br>$not_optional - $optional - $third\n";
}

opt("A", "B", "C");
opt("A", "B");
opt("A", NULL, "C");
opt("C");
opt($third="C");
opt();
?>