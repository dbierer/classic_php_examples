<?php
$board = array (
					1 => array ( "wQR","wQK","wQB","wQU","wKI","wKB","wKK","wKR"),
					2 => array ( "wP8","wP7","wP6","wP5","wP4","wP3","wP2","wP1"),
					3 => array ( "   ","   ","   ","   ","   ","   ","   ","   "),
					4 => array ( "   ","   ","   ","   ","   ","   ","   ","   "),
					5 => array ( "   ","   ","   ","   ","   ","   ","   ","   "),
					6 => array ( "   ","   ","   ","   ","   ","   ","   ","   "),
					7 => array ( "bP1","bP2","bP3","bP4","bP5","bP6","bP7","bP8"),
					8 => array ( "bQR","bQK","bQB","bQU","bKI","bKB","bKK","bKR"),
	);
$count = 1;
$output = "<table border=1>";
for ($y = 1; $y <= 8; $y++ ) {
	$output .= "<tr height=20>";
	for ($x = 0; $x < 8; $x++) {
		$output .= "<td width=20";
		if ($count++ & 1) {
			$output .= ">";
		} else {
			$output .= " bgcolor='yellow'>";
		}
		$output .= ($board[$y][$x] == "  ") ? "&nbsp;&nbsp;" : $board[$y][$x];
		$output .= "</td>";
	}
	$output .= "</tr>\n";
	$count++;
} 
$output .= "</table>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php echo @$output; ?>
</body>
</html>