<?php
$arr = [
	'Test123',
	'123Test',
	'123Test123',
	'Test456',
	'test123',
	'TestSomething',
	'SomethingTest',
];
$search = '/^Test.*/';
var_dump(preg_grep($search, $arr));

// actual output:
/*
array(3) {
  [0]=>
  string(7) "Test123"
  [3]=>
  string(7) "Test456"
  [5]=>
  string(13) "TestSomething"
}
*/
