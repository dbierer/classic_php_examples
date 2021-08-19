<?php
// makes a REST API call to US weather service (free)
// NOTE: this service only returns data for cities in USA
// NOTE: you need to supply latitude and longitude

const API_URL = 'https://api.weather.gov/points/';
const USER_AGENT = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0';

/**
 * Makes weather service forecast request
 * See: https://weather-gov.github.io/api/general-faqs
 *
 * @param float $lat : latitude
 * @param float $lon : longitude
 * @return string $json : returns weather forecast as JSON string
 */
function getForecast(float $lat, float $lon) : string
{
    // make weather forecast request to self::API_URL/lat,lon
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'User-Agent: ' . USER_AGENT,
        ]
    ];
    $context = stream_context_create($opts);
    $url     = API_URL . $lat . ',' . $lon;
    // retrieve forecast URL
    $result  = json_decode(file_get_contents($url, FALSE, $context));
    // make weather forecast request to URL
    $forecast = file_get_contents($result->properties->forecast, FALSE, $context);
    // return results
    return $forecast;
}

// examples:
echo "\nForecast for New York City\n";
echo getForecast(40.71427,-74.00597);

echo "\nForecast for Chicago:\n";
echo getForecast(41.85003,-87.65005);

echo "\nForecast for San Francisco\n";
echo getForecast(37.77493,-122.41942);

