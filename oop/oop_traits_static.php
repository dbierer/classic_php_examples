<?php
// see: http://php.net/manual/en/language.oop5.traits.php
echo '<pre>' . PHP_EOL;
echo phpversion();
echo PHP_EOL;

class TestClass {
    public static $_bar;
}
class Foo1 extends TestClass { }
class Foo2 extends TestClass { }
Foo1::$_bar = 'Hello';
Foo2::$_bar = 'World';
echo Foo1::$_bar . ' ' . Foo2::$_bar; // Prints: World World
echo PHP_EOL;

//Example using trait:
trait TestTrait {
    public static $_bar;
}
class Foo3 {
    use TestTrait;
}
class Foo4 {
    use TestTrait;
}
Foo3::$_bar = 'Hello';
Foo4::$_bar = 'World';
echo Foo3::$_bar . ' ' . Foo4::$_bar; // Prints: Hello World
echo '</pre>' . PHP_EOL;
?>