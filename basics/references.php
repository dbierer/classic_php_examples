<?php
$b=111111; $d=222222;
$a =& $b;
$c =& $d;
$e =& $b;

// now a=b=1; c=d=2;
print "\n1st Pass\n";
print "a = $a\n";
print "b = $b\n";
print "c = $c\n";
print "d = $d\n";
print "e = $e\n";
$b =& $c;

// now a=1, b=c=d=2;
print "\n2nd Pass\n";
print "a = $a\n";
print "b = $b\n";
print "c = $c\n";
print "d = $d\n";
?>