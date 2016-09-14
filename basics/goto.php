<?php
// Yes ... in php 5.3+ there is now (sadly) support for ... shudder ... the "goto" command!
goto a;
echo 'Foo';
 
a:
echo 'Bar';
echo '<br />' . PHP_EOL;

for($i=0,$j=50; $i<100; $i++) {
  while($j--) {
    if($j==17) goto end; 
  }  
}
echo "i = $i";
end:
echo 'j hit 17';
?>
