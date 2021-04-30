<?php
require 'Net/Socket.php';
require 'Net/SMTP.php';

$message = get_include_path();

if (isset($_POST['send'])) {
	$host = $_POST['host'];
	$from = $_POST['from'];
	$rcpt = $_POST['to'];
	$subj = $_POST['subject'];
	$pwd = $_POST['pwd'];
	$body = htmlentities($_POST['body']);
	
	/* Create a new Net_SMTP object. */
	if (! ($smtp = new Net_SMTP($host))) {

		/* Connect to the SMTP server. */
		if (PEAR::isError($e = $smtp->connect())) {

			/* Authenticate */
			if (PEAR::isError($e = $smtp->auth($from,$pwd,""))) {
	
				/* Send the 'MAIL FROM:' SMTP command. */
				if (PEAR::isError($smtp->mailFrom($from))) {
	
					/* Address the message to recipient(s) */
				    if (PEAR::isError($res = $smtp->rcptTo($to))) {

						/* Set the body of the message. */
						if (PEAR::isError($smtp->data($subj . "\r\n" . $body))) {
	//					$smtp->s
							$message = "Message sent successfully!\n";
						} else {
							$message .= "Unable to send data\n";
						}
	
				    } else {
				    	$message .= "Unable to add recipient <$to>: " . $res->getMessage() . "\n";
				    }
	
				} else {
					$message .= "Unable to set sender to <$from>\n";
				}
	
			} else {
				$message .= "Auth: " . $e->getMessage() . "\n";
			}
			
		} else {
			$message .= "Connect: " . $e->getMessage() . "\n";
		}
		
	} else {
	    $message .= "Unable to instantiate Net_SMTP object\n";
	}
	
	/* Disconnect from the SMTP server. */
	$smtp->disconnect();
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SMTP Example</title>
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
<h1>SMTP Example</h1>
<p>&nbsp;</p>
<form name="SMTP" method=POST>
<table border=0>
<tr><th>SMTP Host</th><td><input name="host" type=text size=40 maxlength=255 value="<?php echo @$_POST['host']; ?>" /></td>
<tr><th>From</th><td><input name="from" type=text size=40 maxlength=255 value="<?php echo @$_POST['from']; ?>" /></td>
<tr><th>To</th><td><input name="to" type=text size=40 maxlength=255 value="<?php echo @$_POST['to']; ?>" /></td>
<tr><th>Subject</th><td><input name="subject" type=text size=80 maxlength=255 value="<?php echo @$_POST['subject']; ?>" /></td>
<tr><td colspan=2><textarea name="body" rows="8" cols="80"><?php echo @$_POST['body']; ?></textarea>
<tr><th>Password</th><td><input name="pwd" type=password size=40 maxlength=255 value="<?php echo @$_POST['pwd']; ?>" /></td>
<tr><td colspan=2><input type=submit name="send" value="SEND"></td></tr>
</table>
</form>
<br>
<?php
echo "<br>$message<br>"; 
phpinfo(INFO_VARIABLES); 
?>
<br><a href="index.php">BACK</a>
</body>
</html>
