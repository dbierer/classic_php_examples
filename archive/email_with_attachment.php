<?php
/* 
 * Includes from Pear library (http://pear.php.net/package/Mail_Mime/docs)
 * To install: 
 * #pear install Mail
 * #pear install Mail_Mime
 * 
 */
set_include_path("/usr/local/zend/PEAR");
include('Mail.php');
include('Mail/mime.php');

// Initialize Variables
$message = "";

// Start session
session_start();

// Set directory name of current directory
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

// Check to see if "upload" button pressed
if ( isset($_POST['send'])) {

	// Check to see if upload parameter specified
	if ( $_FILES['upload_file']['error'] == UPLOAD_ERR_OK ) {

		// Check to make sure file uploaded by upload process
		if ( is_uploaded_file ($_FILES['upload_file']['tmp_name'] ) ) {
			
			// Capture filename
			$fn = $_FILES['upload_file']['name'] ;

			// Set filename to current directory
			$copyfile = $dir . basename($fn);
		
			// Copy file
			if ( move_uploaded_file ($_FILES['upload_file']['tmp_name'], $copyfile) ) {

				// Save name of file
				$message .= "<br>File uploaded successfully: " . $fn;
				
			} else {

				// Trap upload file handle errors
				$message .= "<br>Unable to upload file " . $copyfile;
			}
			
		} else {

			// Failed security check
			$message .= "<br>File Not Uploaded";
		}
		
	} else {

		// Failed security check
		$message .= "<br>File Not Uploaded";
	}

	// Initialize Variables
	$from 	 	= $_POST['from'];
	$to		 	= $_POST['to'];
	$cc		 	= $_POST['cc'];
	$reply_to	= $_POST['reply_to'];
	$subject 	= $_POST['subject'];
	$body 	 	= strip_tags($_POST['body']);
		
	// Send notification email  
	try {  
	  
	    // Set variables & format email message  
	    $headers['Subject']	 = $subject;  
	    $headers['From']	 = $from;
	    if ( $cc ) { $headers['CC'] = $cc; }
		if ( $reply_to ) { $headers['Reply-To'] = $reply_to; }
	    
	    // Instantiate object
	    $msg    = new Mail_mime;  
	  
	    // Set text part of the message body  
	    $msg->setTXTBody($body);  
	      
	    // Add attachment if photo was uploaded  
	    if ( file_exists( $copyfile )) {
	    	// Get MIME type of file
	    	$mime_type = get_mime($copyfile);
		    $msg->addAttachment($copyfile, $mime_type);    
	    }  
	          
	    // Send message  
	    $msg_body = $msg->get();  
	    $msg_header = $msg->headers($headers);  
	    $msend =& Mail::factory('mail');  
	    $msend->send( $to, $msg_header, $msg_body ); 
	     
	    // Indicate successful email  
	    $message .= "<br>Email Successfully Sent\n";  
	      	  
	}  
	catch (Exception $e) {  
	  
	    $message .= "Unable to Send Mail: " . $e->getMessage()  . ' ';  
	  
	}
}

function get_mime($filename){
    preg_match("/\.(.*?)$/", $filename, $m);    # Get File extension for a better match
    switch(strtolower($m[1])){
        case "js": return "application/javascript";
        case "json": return "application/json";
        case "jpg": case "jpeg": case "jpe": return "image/jpg";
        case "png": case "gif": case "bmp": return "image/".strtolower($m[1]);
        case "css": return "text/css";
        case "xml": return "application/xml";
        case "html": case "htm": case "php": return "text/html";
        default: return "text/html";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Upload File</title>
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
<h1>Email With Attachment Example</h1>
<form name="Email_with_Attachment" method=POST enctype="multipart/form-data">
<table border=0>
<tr><th>From</th><td><input name="from" type=text size=40 maxlength=255 value="<?php echo @$_POST['from']; ?>" /></td></tr>
<tr><th>To</th><td><input name="to" type=text size=40 maxlength=255 value="<?php echo @$_POST['to']; ?>" /></td></tr>
<tr><th>CC</th><td><input name="cc" type=text size=40 maxlength=255 value="<?php echo @$_POST['cc']; ?>" /></td></tr>
<tr><th>Reply To</th><td><input name="reply_to" type=text size=40 maxlength=255 value="<?php echo @$_POST['reply_to']; ?>" /></td></tr>
<tr><th>Subject</th><td><input name="subject" type=text size=80 maxlength=255 value="<?php echo @$_POST['subject']; ?>" /></td></tr>
<tr><td colspan=2><textarea name="body" rows="8" cols="80"><?php echo @htmlentities($_POST['body']); ?></textarea></td></tr>
<tr><th>Upload File</th><td><input type=file method=POST enctype="multipart/form-data" size=50 maxlength=255 name="upload_file" value="" /></td></tr>
<tr><td colspan=2><input type=submit name="send" value="SEND"></td></tr>
</table>
</form>
<br><a href="index.php">BACK</a>
<?php 
echo "<p>" . $message . "</p>\n";
phpinfo(INFO_VARIABLES); 
?>
</body>
</html>
