<?php
class Test
{
	public const FIELDS = ['fname','lname','balance'];
	public $vars = [];
    // Returns an inaccessible property
    public function __set($key, $value) {
        if (in_array($key, self::FIELDS)) {
			$this->vars[$key] = $value;
		}
    }
    public function __get($key) {
        return $this->vars[$key] ?? '';
    }
}

$test = new Test();
$test->fname = 'Fred';
$test->lname = 'Flintstone';
$test->balance = 999.99;
$test->doesNotExist = 'TEST';
echo $test->fname . ' ' . $test->lname
	 . ' has a balance of ' . $test->balance
	 . ' and ' . $test->doesNotExist;
