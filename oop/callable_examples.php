<?php
function test(callable $callback, array $params = [])
{
    return 'Sum: ' . $callback($params);
}

class Test
{
    public function sum($arr)
    {
        return array_sum($arr);
    }
    public static function static_sum($arr)
    {
        return array_sum($arr);
    }
    public function __invoke($arr)
    {
        return array_sum($arr);
	}
}

$anon = new class () {
	public function __invoke($arr) {
		return array_sum($arr);
	}
};

$callback_tree = [
    'anon_func'      => function ($arr) { return array_sum($arr); },
    'arrow_func'     => fn ($arr) => array_sum($arr),
    'anon_class'     => $anon,
    '__invoke'       => new Test(),
    'php_func'       => 'array_sum',
    'obj_method'     => [new Test(), 'sum'],
    'static_method1' => 'Test::static_sum',
    'static_method2' => [Test::class, 'static_sum'],
];

$arr = [1,2,3,4,5,6,7,8,9];
foreach ($callback_tree as $key => $item) {
    printf("\n%20s: %3d", $key, $item($arr));
}

/*
 * Output:
           anon_func:  45
          arrow_func:  45
          anon_class:  45
            __invoke:  45
            php_func:  45
          obj_method:  45
      static_method1:  45
      static_method2:  45
*/
