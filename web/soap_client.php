<?php
// see: https://graphical.weather.gov/xml/
/*
 * <operation name="NDFDgenByDay">
 * <documentation>
 * Returns National Weather Service digital weather forecast data.
 * Supports latitudes and longitudes for the Continental United States, Hawaii, Guam, and Puerto Rico only.
 * Allowable values for the input variable "format" are "24 hourly" and "12 hourly".
 * The input variable "startDate" is a date string representing the first day (Local) of data to be returned.
 * The input variable "numDays" is the integer number of days for which the user wants data.
 * Allowable values for the input variable "Unit" are "e" for U.S. Standare/English units and "m" for Metric units.
 * </documentation>
 * <input message="tns:NDFDgenByDayRequest"/>
 * <output message="tns:NDFDgenByDayResponse"/>
 * </operation>
 */

// Initialize variables
$format = '24 hourly';
$units  = 'm';
$startTime = new DateTime();
$numDays = 7;
$params = '';
$weather = '';
$wsdl = 'https://graphical.weather.gov/xml/SOAP_server/ndfdXMLserver.php?wsdl';
$options = [
    'cache_wsdl'     => WSDL_CACHE_NONE,
    'trace'          => 1,
    'stream_context' => stream_context_create(
        [
            'http' => [ 'user_agent' => 'PHPSoapClient' ],
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true
            ]
        ]
    )
];

// Get info from HTML form
$currentLatLon = (isset($_GET['city'])) ? strip_tags(urldecode($_GET['city'])) : '';

// Instantiate soap client
$soap = new SoapClient($wsdl, $options);

// Call a function $soap->LatLonListCityNames(1) as defined in the WSDL
$xml = new SimpleXMLElement($soap->LatLonListCityNames(1));
$cityNames = explode('|', $xml->cityNameList);
$latLonCity = explode(' ', $xml->latLonList);
$cityLatLon = array_combine($latLonCity, $cityNames);

// process request
if ($currentLatLon) {
    list($lat, $lon) = explode(',', $currentLatLon);
    try {
        /*
         * <message name="NDFDgenByDayRequest">
         * <part name="latitude" type="xsd:decimal"/>
         * <part name="longitude" type="xsd:decimal"/>
         * <part name="startDate" type="xsd:date"/>
         * <part name="numDays" type="xsd:integer"/>
         * <part name="Unit" type="xsd:string"/>
         * <part name="format" type="xsd:string"/>
         * </message>
         */
        $weather = $soap->NDFDgenByDay($lat,$lon,$startTime->format('Y-m-d'),$numDays,$unit,$format);
    } catch (Exception $e) {
        $weather .= PHP_EOL;
        $weather .= 'Latitude: ' . $lat . ' | Longitude: ' . $lon . PHP_EOL;
        $weather .= 'ERROR' . PHP_EOL;
        $weather .= $e->getMessage() . PHP_EOL;
        $weather .= $soap->__getLastResponse() . PHP_EOL;
    }
}
?>
<!DOCTYPE html>
<head>
    <title>PHP 7 Cookbook</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="php7cookbook_html_table.css">
</head>
<body>

<div class="container">

    <h1>Weather Forecast</h1>
    <form method="get" name="forecast">
    <table>
        <tr>
        <th style="background-color: yellow;">City List</th>
        <td>
            <select name="city">
                <?php foreach ($cityLatLon as $latLon => $city) : ?>
                    <?php $select = ($currentLatLon == $latLon) ? ' selected' : ''; ?>
                    <option value="<?= urlencode($latLon) ?>" <?= $select ?>><?= $city ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <th style="background-color: yellow;">&nbsp;</th>
        <td><input type="submit" value="OK"></td>
        </tr>
    </table>
    </form>
</div>
<div class="container">
    <pre>
        <?= $weather; ?>
    </pre>
</div>
&copy; 2017 <i>PHP 7 Cookbook</i>, by Doug Bierer, Packt Publishing Ltd. Used with permission of the author
</body>
</html>
