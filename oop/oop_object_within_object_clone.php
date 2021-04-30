<?php
class Contained {
    public $someVariable;
}

class Container {
    public $containedVariable;
}

$aContainedObject = new Contained();
$aContainedObject->someVariable = 3;

$toBeCloned = new Container();
$toBeCloned->containedVariable = $aContainedObject;
$clonedObject = clone $toBeCloned;

echo "toBeCloned: ";
var_dump($toBeCloned);
echo "\r\n<br /><br />\r\n";

echo "clonedObject: ";
var_dump($clonedObject);
echo "\r\n<br /><br />\r\n";

$aContainedObject->someVariable = "new value";

echo "toBeCloned: ";
var_dump($toBeCloned);
echo "\r\n<br /><br />\r\n";

echo "clonedObject: ";
var_dump($clonedObject);
echo "\r\n<br /><br />\r\n";
?>

