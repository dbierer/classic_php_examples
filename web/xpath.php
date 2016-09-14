<?php
$string = <<<XML
<a>Label A
 <b>Label B
  <c name="something">text</c>
  <c name="anything">stuff</c>
 </b>
 <d>Label D
  <c name="nothing">code</c>
 </d>
 <d>2nd Label D
  <c name="nothing">other</c>
 </d>
</a>
XML;
$xml = new SimpleXMLElement($string);
/* Search for <a><b><c> */
$result = $xml->xpath('/a/b/c');
display($result,'/a/b/c');
/* Relative paths also work... */
$result = $xml->xpath('d/c');
display($result,'d/c');
/* Search for attributes*/
$result = $xml->xpath('//@name');
display($result,'//@name');
/* Everything */
$result = $xml->xpath('//*');
display($result,'//*');

function display ($result, $label) {
	echo "\n$label\n";
	while(list( , $node) = each($result)) {
	    printf("%-20s:  %s\n",$label,$node);
	}
}
?>
