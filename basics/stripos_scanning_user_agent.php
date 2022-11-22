<?php
$agent = $_SERVER['HTTP_USER_AGENT'];
switch (TRUE) {
	case stripos($agent, 'linux') :
		$os = 'Linux system detected';
		break;
	case stripos($agent, 'windows') :
		$os = 'Windows system detected';
		break;
	default :
		$os = 'Unknown';
}
switch (TRUE) {
	case stripos($agent, 'chrome') :
		$browser = 'Chrome browser detected';
		break;
	case stripos($agent, 'firefox') :
		$browser = 'Firefox browser detected';
		break;
	case stripos($agent, 'safari') :
		$browser = 'Firefox browser detected';
		break;
	default :
		$browser = 'Unknown';
}
echo "We have detected the following:<br />\n";
echo $browser . "<br />\n";
echo $os . "<br />\n";

