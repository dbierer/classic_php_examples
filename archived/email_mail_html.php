<?php
$message = "";

if (isset($_POST['send'])) {

	// Initialize Variables
	$from 	 	= strip_tags($_POST['from']);
	$to		 	= strip_tags($_POST['to']);
	$cc		 	= strip_tags($_POST['cc']);
	$bcc	 	= strip_tags($_POST['bcc']);
	$reply_to	= strip_tags($_POST['reply_to']);
	$subject 	= strip_tags($_POST['subject']);
	$subject	= str_ireplace("\n", ' ', $subject);
	$body 	 	= strip_tags($_POST['body'],'<h1><h2><h3><p><b><i><ul><li><hr>');	// NOTE: allows some HTML
	$bodyShow	= htmlentities($body);
	
	// Format mail headers
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: ' 	 . $from 	. "\r\n";
	if ( isset($cc) ) 		{ 	$headers .= 'CC: ' 		 . $cc		. "\r\n";	}
	if ( isset($bcc) ) 		{ 	$headers .= 'BCC: ' 	 . $bcc		. "\r\n";	}
	if ( isset($reply_to))	{ 	$headers .= 'Reply-To: ' . $reply_to . "\r\n";	}
    $headers	.=	'X-Mailer: PHP/' . phpversion();
	
	// Send mail
	if ( mail($to,$subject,$body,$headers)) {
		$message = "<br>Message Successfully Sent\n";
	} else {
		$message = "<br>Error: Unable to Send Message\n";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Email Example</title>
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
<h1>HTML Email Example</h1>
<p>&nbsp;</p>
<form name="SMTP" method=POST>
<table border=0>
<tr><th>From</th><td><input name="from" type=text size=40 maxlength=255 value="<?php echo @$from; ?>" /></td></tr>
<tr><th>To</th><td><input name="to" type=text size=40 maxlength=255 value="<?php echo @$to; ?>" /></td></tr>
<tr><th>CC</th><td><input name="cc" type=text size=40 maxlength=255 value="<?php echo @$cc; ?>" /></td></tr>
<tr><th>Reply To</th><td><input name="reply_to" type=text size=40 maxlength=255 value="<?php echo @$reply_to; ?>" /></td></tr>
<tr><th>Subject</th><td><input name="subject" type=text size=80 maxlength=255 value="<?php echo @$subject; ?>" /></td></tr>
<tr><td colspan=2><textarea name="body" rows="8" cols="80"><?php echo @$bodyShow; ?></textarea></td></tr>
<tr><td colspan=2><input type=submit name="send" value="SEND"></td></tr>
</table>
</form>
<br>
<?php echo "<br>$message<br>"; ?>
<br><a href="index.php">BACK</a>
<?php //phpinfo(INFO_VARIABLES); ?> 
</body>
</html>
