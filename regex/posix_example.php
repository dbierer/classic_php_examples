<?php
// NOTE: although the documentation states POSIX notation is supported,
//       the following error message appears in PHP 8 and above:
//       Warning:  preg_match(): Compilation failed: POSIX named classes are supported only within a class

// simulates $_POST
$_POST = [
    'good' => [
        'username' => 'mwop1234',
        'state' => 'NY',
        'zip' => '12345-7890',
    ],
    'bad' => [
        'username' => 'bad<script>user</script>name',
        'state' => 'DoesNotExist',
        'zip' => '12345BAD',
    ]
];

$pattern = [
    'username' => '/^[:alnum:]$/',
    'state' => '/^[:uppper:]{2}$/',
    'zip' => '/^[:digit:]{5}(-[:digit:]{4})?/',
];

class Test
{
    public function validate(array $post, array $pattern)
    {
        $output = '';
        foreach ($post as $key => $item) {
            $test = $pattern[$key];
            $valid = preg_match($test, $item);
            $output .= "\n$key :";
            $output .= htmlspecialchars($item) . ' is ';
            $output .= ($valid) ? 'VALID' : 'NOT VALID';
        }
    }
}
$test = new Test();

foreach ($_POST as $type => $values) {
    echo "\n$type";
    echo $test->validate($values, $pattern);
}

