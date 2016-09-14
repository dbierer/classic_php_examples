<?php
// Parent class
class Math {
	function add($a,$b) {
		return $a + $b; 
	}
}

// Child class
class WordMath extends Math {
	private $words = array ("zero","one","two","three","four","five","six","seven","eight","nine");
	function convert($word) {
		return array_search($word,$this->words);
	}
	function add($a,$b) {
		return parent::add($this->convert($a),$this->convert($b));
	}
}

$m = new Math();
echo $m->add(2,2);
echo "\n";
$w = new WordMath();
echo $w->add("two","two"); 
?>