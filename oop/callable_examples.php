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
}

$callback_tree = [
    'anon_func' => function ($arr) { return array_sum($arr); },
    'arrow_func' => fn ($arr) => array_sum($arr),
    'anon_class' => new class () {
        public function __invoke($arr) {
            return array_sum($arr);
        }
    },
    'php_func' => 'array_sum',
    'obj_method' => [new Test(), 'sum'],
    'static_method' => 'Test::static_sum',
];

$arr = [1,2,3,4,5,6,7,8,9];
foreach ($callback_tree as $key => $item) {
    printf("\n%14s: %3d", $key, $item($arr));
}
