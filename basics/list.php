<?php
$a = array(
	array("Ed","Cass","Cassidy","Drummer","Spirit"),
	array("Christine","Ellen","Hynd","Vocalist","The Pretenders"),
	array("Roger","Keith","Barrett","Guitarist","Pink Floyd"),
	array("Colin","James","Hay","Vocalist","Men At Work")
	);
$output = "<table border=1>";
$output .= "<tr bgcolor='yellow'><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Role</th><th>Band</th></tr>\n";
$count = 0;
foreach ($a as $rockStar) {
	list($first, $middle, $last, $role, $band) = $rockStar;
	if ($count++ % 2) {
		$output .= "<tr bgcolor='yellow'>";
	} else {
		$output .= "<tr bgcolor='gray'>";
	}
	$output .= "<td>$first</td><td>$middle</td><td>$last</td><td>$role</td><td>$band</td></tr>\n";
}
$output .= "</table>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
TD {
	font: 10pt helvetica;
	width: 100px;
}
TH {
	font: bold 10pt helvetica;
	width: 100px;
}
</style>
</head>
<body>
<?php echo @$output; ?>
</body>
</html>
