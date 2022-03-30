<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>POP3 Example</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<form name="ImapExample" method=POST>
<?php
$host = "pop.1and1.com";
$user = "test@unlikelysource.com";
$pwd = "Password!2";
$fmt = "{" . $host . "/pop3:110}";
$mbox = imap_open($fmt, $user, $pwd);

echo "<h1>Mailboxes</h1>\n";
$folders = imap_list($mbox, $fmt, "*");

if ($folders == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($folders as $val) {
        echo $val . "<br />\n";
    }
}

echo "<h1>Headers in INBOX</h1>\n";
$headers = imap_headers($mbox);

echo "<table>\n";

if ($headers == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($headers as $val) {
    	// Parse out the number
    	$start = strpos($val," ");
    	$stop = strpos($val,")");
    	$num = (int) substr($val, $start, $stop - $start);
    	$text = substr($val,$stop+1);
    	echo "<tr>";
        echo "<td><input type=checkbox name='header[" . $num . "]'>";
        echo "<td>" . htmlentities($text);
        echo "<input type=hidden name='ref[" . $num . "]' value='" . $num . "'/>";
        // Check to see if body was checkmarked
        if (isset($_POST['header'][$num])) {
        	echo "<hr><p>" . htmlentities(imap_body($mbox,$_POST['ref'][$num])) . "</p>";
        }
        echo "</td></tr>\n";
    }
}

echo "</table>\n";

imap_close($mbox);
?>
<br><input type=submit name="read" value="Read Checkmarked" />
</form>
<br><a href="index.php">BACK</a>
</body>
</html>
