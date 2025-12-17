<?php
// __serialize() / __unserialize() Example
class Rocket 
{
    protected $fuel    = 'oxygen';
    protected $engType = 'Merlin';
    protected $secret  = 'Super Secret';
    public function __serialize()
    {
        // save the secret on the server
        $safe_fn = bin2hex(random_bytes(8)) . '.txt';
        setcookie('token', $safe_fn);
        file_put_contents($safe_fn, $this->secret);
        // don't put the secret in the serialization
        // + add a date/time marker
        return [
            'fuel' => $this->fuel,
            'engType' => $this->engType,
            'date' => date('Y-m-d H:i:s')
        ];
    }
    public function __unserialize($arr)
    {
        // restore the secret from the server
        $safe_fn = $_COOKIE['token'];
        if (file_exists($safe_fn)) {
            $this->secret = file_get_contents($safe_fn);
        }
        // don't put the secret in the serialization
        // + add a date/time marker
        $this->fuel = $arr['fuel'];
        $this->engType = $arr['engType'];
    }
}
$rocket = new Rocket();
$objstr = serialize($rocket);
echo '<pre>';
echo $objstr . PHP_EOL;
unset($rocket);
$newRocket = unserialize($objstr);
print_r($newRocket);
echo '</pre>';

// output (from browser)
/*
O:6:"Rocket":3:{s:4:"fuel";s:6:"oxygen";s:7:"engType";s:6:"Merlin";s:4:"date";s:19:"2025-08-27 04:26:10";}
Rocket Object
(
    [fuel:protected] => oxygen
    [engType:protected] => Merlin
    [secret:protected] => Super Secret
)
*/
