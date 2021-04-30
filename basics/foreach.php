<?php
// Question: how can you update array values?
$increase = 1.1;
$quotas = array( "Jim" => "5781", "Jane" => "4742", "Joe" => "2729");
print_r($quotas);
foreach ($quotas as $key => &$item ) {
	$item *= $increase;
	printf("%s's quota = $%6.2f\n",$key, $item);
}
print_r($quotas);
?>	