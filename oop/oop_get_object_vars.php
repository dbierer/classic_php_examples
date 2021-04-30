<?php
class Test
{
    public $youCanSeeMe = 'You Can See Me';
    public $youCanSeeThis = 'You Can See This';
    protected $onlySomeCanSee = 'Only Some Can See Me';
    protected $onlySomeCanThis = 'Only Some Can See This';
    public function whatCanYouSee()
    {
        return get_object_vars($this);
    }
}

$test = new Test;
echo "\n--------------------------------\n";
echo "From Outside Class:\n";
echo "\n--------------------------------\n";
var_dump(get_object_vars($test));

echo "\n--------------------------------\n";
echo "From Inside Class:\n";
echo "\n--------------------------------\n";
var_dump($test->whatCanYouSee());

