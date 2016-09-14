<?php
class Process {
	public $name = "NotThere";
	function __construct($token) {
		setcookie($this->name,$token,time()+60*60);
	}
	function getCookie() {
		return $_COOKIE[$this->name];
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cookie Not There</title>
</head>
<body>
<h1>Cookie Not There</h1>
<p>&nbsp;</p>
<?php 
$token = date("Y-m-d-H:i:s");
$instance = new Process($token);
echo $instance->getCookie();
?>
</body>
</html>
