<?php
// Sample XML doc
$xml_doc = <<<EOT
<country id="ZZ">
<name>My Land</name>
<location>15E</location>
<area>40000</area>

    <state1>
<name>Hi State</name>
<area>1000</area>
<population>2000</population>

    <city1>
<location>13E</location>
<population>500</population>
<area>500</area>
</city1>

    <city2>
<location>13E</location>
<population>500</population>
<area>5000</area>
</city2>
</state1>

    <state2>
<name>Low State</name>
<area>3000</area>
<population>20000</population>

    <city1>
<location>15E</location>
<population>5000</population>
<area>1500</area>
</city1>
</state2>
</country>
EOT;
$xml_parser = xml_parser_create();
xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0); 
$xml_values = array();
xml_parse_into_struct($xml_parser, $xml_doc, $xml_values);
xml_parser_free($xml_parser);
foreach ($xml_values as $element) {
	echo implode(' : ', $element) . PHP_EOL;
}
?>