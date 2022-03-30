<?php
// Initialize variables
$product = "time-series";
$endTime = date("Y-m-d",time()) . "T00:00:00";
$startTime = date("Y-m-d",($endTime - 60*60*24)) . "T00:00:00";

// Get info from HTML form
$ok = isset($_POST['OK']) ? $_POST['OK'] : "";
$zip = isset($_POST['zip']) ? $_POST['zip'] : "";
$city = isset($_POST['city']) ? $_POST['city'] : "";

// Instantiate soap client
$wsdl = 'http://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$soap = new SoapClient($wsdl, array('trace' => TRUE));
// Call a function as defined in the API documentation
// http://www.nws.noaa.gov/forecasts/xml/
// $result = (string) of XML data
$result = $soap->LatLonListCityNames(1);
// Set up XML parser
$p = xml_parser_create();
// Break up XML data into values and indices 
xml_parse_into_struct($p, $result, $vals, $index);
xml_parser_free($p);
// Extract city names
$cities = explode("|",$vals[3]['value']);
// Extract Latitude and Longitude
$lat_lon = explode(" ",$vals[1]['value']);

// NDFD Options
$ndfd = array (
	"maxt" => "Maximum Temperature",
	"mint" => "Minimum Temperature",
	"temp" => "3 Hourly Temperature",
	"dew" => "Dewpoint Temperature",
	"appt" => "Apparent Temperature",
	"pop12" => "12 Hour Probability of Precipitation",
	"qpf" => "Liquid Precipitation Amount",
	"snow" => "Snowfall Amount",
	"sky" => "Cloud Cover Amount",
	"rh" => "Relative Humidity",
	"wspd" => "Wind Speed",
	"wdir" => "Wind Direction",
	"wx" => "Weather",
	"icons" => "Weather Icons",
	"waveh" => "Wave Height",
	"incw34" => "Probabilistic Tropical Cyclone Wind Speed >34 Knots (Incremental)",
	"incw50" => "Probabilistic Tropical Cyclone Wind Speed >50 Knots (Incremental)",
	"incw64" => "Probabilistic Tropical Cyclone Wind Speed >64 Knots (Incremental)",
	"cumw34" => "Probabilistic Tropical Cyclone Wind Speed >34 Knots (Cumulative)",
	"cumw50" => "Probabilistic Tropical Cyclone Wind Speed >50 Knots (Cumulative)",
	"cumw64" => "Probabilistic Tropical Cyclone Wind Speed >64 Knots (Cumulative)",
	"wgust" => "Wind Gust",
	"conhazo" => "Convective Hazard Outlook",
	"ptornado" => "Probability of Tornadoes",
	"phail" => "Probability of Hail",
	"ptstmwinds" => "Probability of Damaging Thunderstorm Winds",
	"pxtornado" => "Probability of Extreme Tornadoes",
	"pxhail" => "Probability of Extreme Hail",
	"pxtstmwinds" => "Probability of Extreme Thunderstorm Winds",
	"ptotsvrtstm" => "Probability of Severe Thunderstorms",
	"pxtotsvrtstm" => "Probability of Extreme Severe Thunderstorms",
	"tmpabv14d" => "Probability of 8- To 14-Day Average Temperature Above Normal",
	"tmpblw14d" => "Probability of 8- To 14-Day Average Temperature Below Normal",
	"tmpabv30d" => "Probability of One-Month Average Temperature Above Normal",
	"tmpblw30d" => "Probability of One-Month Average Temperature Below Normal",
	"tmpabv90d" => "Probability of Three-Month Average Temperature Above Normal",
	"tmpblw90d" => "Probability of Three-Month Average Temperature Below Normal",
	"prcpabv14d" => "Probability of 8- To 14-Day Total Precipitation Above Median",
	"prcpblw14d" => "Probability of 8- To 14-Day Total Precipitation Below Median",
	"prcpabv30d" => "Probability of One-Month Total Precipitation Above Median",
	"prcpblw30d" => "Probability of One-Month Total Precipitation Below Median",
	"prcpabv90d" => "Probability of Three-Month Total Precipitation Above Median",
	"prcpblw90d" => "Probability of Three-Month Total Precipitation Below Median",
	"precipa_r" => "Real-time Mesoscale Analysis Precipitation",
	"sky_r" => "Real-time Mesoscale Analysis GOES Effective Cloud Amount",
	"td_r" => "Real-time Mesoscale Analysis Dewpoint Temperature",
	"temp_r" => "Real-time Mesoscale Analysis Temperature",
	"wdir_r" => "Real-time Mesoscale Analysis Wind Direction",
	"wwa" => "Watches, Warnings, and Advisories",
	"wspd_r" => "Real-time Mesoscale Analysis Wind Speed"
);
// Check to see if OK button pressed
if ($ok) {
	// Check to see if ZIP info was included
	if ($zip) {
		// Returns string with Lat, Long
		$pair = $soap->LatLonListZipCode($zip);
	// Otherwise assume a city was selected
	} else {
		// Returns a string with Lat, Long based on city
		$pair = $lat_lon[$city];
	}
	// Extract lat and long
	list($latitude,$longitude) = explode(",",$pair);
	// Put together parameters
	$weatherParameters = '';
	foreach ($ndfd as $key => $value) {
		if (isset($_POST['ndfd']["$key"])) {
			$weatherParameters .= $key . "=TRUE,";
		} 
	}
	// Get rid of last ","
	$weatherParameters = substr($weatherParameters, 0, -1);
	try {
		$weather = $soap->NDFDgen($latitude,$longitude,$product,$startTime,$endTime,$weatherParameters);
		var_dump($weather);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	debug_print_backtrace();
	phpinfo(INFO_VARIABLES);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SOAP Client Example</title>
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
<h1>Soap Client Example</h1>
<h3>Weather Data</h3>
<form name="SoapClientExample" method=POST>
<br><input type=submit name="OK" value="OK" />
<table>
<tr>
<th>Select by City</th>
<td>
<select name="city">
<option>--- Choose a City ---</option>
<?php
$x = 0;
foreach($cities as $item) {
	echo "<option value='" . $x++ . "'>" . $item . "</option>"; 
}
?>
</select>
</tr>
<tr>
<th>Select by Zip Code</th>
<td>
<input name="zip" type=text size=5 maxlength=5 />
</tr>
<tr><th colspan=2>Variables</th></tr>
<?php 
foreach($ndfd as $key => $value) {
	echo "<tr>";
	echo "<td>" . $value . "</td>";
	echo "<td><input type=checkbox name=\"ndfd[" . $key . "]\" value='" . $key . "'/></td>";
	echo "</tr>\n";	
}
?>
</table>
<br><input type=submit name="OK" value="OK" />
</form>
<br>Available WSDL Functions:
<br>
<pre>
<?php var_dump($soap->__getLastRequestHeaders()); ?>
</pre>
<?php echo implode("<br .>",$soap->__getFunctions()); ?>
</body>
</html>
