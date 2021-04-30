<?php
// runs XPATH query and returns result
function showResult($query, $xml) : string
{
    $output = "\n*****************************\n";
    $result = $xml->xpath($query);
    $output .= 'Query: ' . $query . PHP_EOL;
    $output .= var_export($result, TRUE);
    $output .= "\n*****************************\n";
    return $output;
}

// define XML doc
$string = <<<XML
<root>
    <foo>
      <bar id="1">One</bar>
      <bar id="2">Two</bar>
      <bar id="3">Three</bar>
    </foo>
    <not_foo>
      <bar id="1">One</bar>
      <bar id="2">Two</bar>
      <bar id="3">Three</bar>
    </not_foo>
    <one>
        <foo>
          <bar id="1">One</bar>
          <bar id="2">Two</bar>
          <bar id="3">Three</bar>
        </foo>
    </one>
    <two>
        <foo>
          <bar id="1">One</bar>
          <bar id="2">Two</bar>
          <bar id="3">Three</bar>
        </foo>
    </two>
</root>
XML;

$xml = new SimpleXMLElement($string);

// this shows all foo/bar elements where id=2
echo showResult('//foo/bar[@id=2]', $xml);

// this only shows top foo/bar elements where id=2
echo showResult('foo/bar[@id=2]', $xml);

// this shows all bar elements where id=2
echo showResult('//bar[@id=2]', $xml);

// this shows all foo/bar elements
echo showResult('//foo/bar', $xml);

