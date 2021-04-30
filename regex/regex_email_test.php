<?php
// Test emails
$email = array ('doug@unlikelysource.com',
				'joe-smith@unlikelysource.com',
				'brian.smythe@newbury.co.uk',
				'first.last@yahoo.com.mx',
				'life_is_goo@goodlife.com',
				'life_is_goo@goodlife.notavalidext',
				'.a@g.com',
				'%%%@something.else',
				'doug@syz.museum',
				'shoud not work@no.good',
				"this one won't work",
				' @ ',
				'drmike@eid-dentistry.com',
				"email@with.bad.code<script>alert('test');</script>",
				''
				);
// Create regex	
$pattern = '/^\w([\w._]|-)+\@(([\w._]|-)+\.)+[\w]+$/';
// Print results
foreach ($email as $test) {
	$match = preg_match($pattern,$test) ? "MATCH" : "NO MATCH";
	printf ("%-'.32s \t%s\n", $test, $match);
}
?>
