<?php
// examples showing a PHP array in different formats
$data = [
	'users' => [
		'firstName' => 'John',
		'lastName'  => 'Smith',
		'isAlive'   => true,
		'age'       => 25,
		'address'   => [
			'street'         => '21 2nd Street',
			'city'           => 'Toronto',
			'state_province' => 'Ontario ',
			'postalCode'     => 'MC3 0C1'
		]
	]
];
	
function altYamlEmit(array $data)
{
	static $level = 1;
	$output = '';
	foreach ($data as $key => $item) {
		if (is_array($item)) {
			$output .= str_repeat(' ', $level) . $key . ' : ' . PHP_EOL;
			$level++;
			$output .= altYamlEmit($item);
			$level--;
		} else {
			$output .= str_repeat(' ', $level) . $key . ' : ' . $item . PHP_EOL;
		}
	}
	return $output;
}

// Modified from: http://stackoverflow.com/questions/1397036/how-to-convert-array-to-simplexml
// Author: Hanmat (http://stackoverflow.com/users/748813/hanmant)
function array_to_xml(array $data, &$xml_data) 
{
    foreach( $data as $key => $value ) {
        if(is_numeric($key)){
            $key = 'item' . $key; //dealing with <0/>..<n/> issues
        }
        if( is_array($value) ) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key",htmlspecialchars("$value"));
        }
     }
     return str_replace('><', ">\n<", $xml_data->asXml());
}

// JSON
echo '<pre>';
echo "\nJSON";
echo "\n----------------------------------------\n";
echo json_encode($data,  JSON_PRETTY_PRINT);
echo PHP_EOL;

// YAML
echo "\nYAML";
echo "\n----------------------------------------\n";
if (function_exists('yaml_emit')) {
	echo yaml_emit($data);
} else {
	echo altYamlEmit($data);
}
echo PHP_EOL;

// XML
echo "\nXML";
echo "\n----------------------------------------\n";
echo array_to_xml($data, new SimpleXMLElement('<?xml version="1.0"?><data></data>'));
echo PHP_EOL;

echo '</pre>';
