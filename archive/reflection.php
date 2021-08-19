<?php
/*
 * PHP 5 comes with a complete reflection API that adds the 
 * ability to reverse-engineer classes, interfaces, functions 
 * and methods as well as extensions. Additionally, the 
 * reflection API also offers ways of retrieving doc comments 
 * for functions, classes and methods. 
 * 
 * See: http://us.php.net/manual/en/language.oop5.reflection.php#language.oop5.reflection.reflectionfunction
 * 
 */
// Simple Example:
// Reverse engineer the "Exception" class
//
Reflection::export(new ReflectionClass('Exception'));
?>
