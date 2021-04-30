--TEST--
Test Crypt_Blowfish in CBC mode
--FILE--
<?php
if (!function_exists('hex2bin')) {
    function hex2bin($data)
    {
        $len = strlen($data);
        return pack('H' . $len, $data);
    }
}

print "key              iv               plain                            encrypted                        actual encrypt                   actual decrypt                   encrypt decrypt\n";

$vectors = file(dirname(__FILE__) . '/vectors_cbc.txt');

/**
 * To prepare this test file, generates the data to compare to using the mcrypt
 * extension
 *
$crypt = mcrypt_module_open(MCRYPT_BLOWFISH, '', 'cbc', '');

foreach ($vectors as $data) {
    $data = trim($data);
    if ($data) {
        list($key, $iv, $plain, $guess) = split('[[:space:]]+', $data);

        // Generate an IV
        $iv = mcrypt_create_iv(8, MCRYPT_RAND);

        printf('%s  %s  %s ',
            $key,
            bin2hex($iv),
            $plain
        );
        $key = hex2bin(trim($key));
        $plain = hex2bin(trim($plain));

        mcrypt_generic_init($crypt, $key, $iv);
        $guess = mcrypt_generic($crypt, $plain);
        $guess = bin2hex($guess);
        printf("%s  %s  OK\n",
            $guess,
            $guess
        );
    }
}
exit;
*/

require_once 'Crypt/Blowfish.php';
$b =& Crypt_Blowfish::factory('cbc', null, null, CRYPT_BLOWFISH_PHP);
if (PEAR::isError($b)) {
    echo 'Error: ' . $b->getMessage() . "\n";

} else {
    list($m, $t1) = explode(' ', microtime());
    $t1 += $m;

    foreach ($vectors as $data) {
        $data = trim($data);
        if ($data) {
            list($key, $iv, $plain, $crypt) = split('[[:space:]]+', $data);
            printf('%s %s %s ',
                $key,
                $iv,
                $plain
            );
            $key   = hex2bin(trim($key));
            $iv    = hex2bin(trim($iv));
            $plain = hex2bin(trim($plain));
            $crypt = strtolower(trim($crypt));
            $result = $b->setKey($key, $iv);
            if (PEAR::isError($result)) {
                echo 'Error with key/IV: ' . $result->getMessage() . "\n";
                continue;
            }

            $guess = $b->encrypt($plain);
            if (PEAR::isError($guess)) {
                echo 'Error while encrypting: ' . $guess->getMessage() . "\n";
                continue;
            }
            $guess = strtolower(bin2hex($guess));

            // Reset the key (mostly for mcrypt compatibility)
            $result = $b->setKey($key, $iv);
            if (PEAR::isError($result)) {
                echo 'Error with key/IV: ' . $result->getMessage() . "\n";
                continue;
            }

            $reverse = $b->decrypt(hex2bin($crypt));
            if (PEAR::isError($guess)) {
                echo 'Error while decrypting: ' . $guess->getMessage() . "\n";
                continue;
            }

            printf("%s %s %s %-7s %s\n",
                $crypt,
                $guess,
                strtolower(bin2hex($reverse)),
                (($crypt == $guess)   ? 'OK' : 'BAD'),
                (($plain == $reverse) ? 'OK' : 'BAD')
            );
        }
    }
    list($m, $t2) = explode(' ', microtime());
    $t2 += $m;

    //echo 'Time: ' . ($t2 - $t1) . "\n";
}

?>
--EXPECT--
key              iv               plain                            encrypted                        actual encrypt                   actual decrypt                   encrypt decrypt
0000000000000000 e4597a95ce318f00 00000000000000000000000000000000 a8272015924885b90bf6094d60ab675c a8272015924885b90bf6094d60ab675c 00000000000000000000000000000000 OK      OK
FFFFFFFFFFFFFFFF 034d82b5db2cbed1 ffffffffffffffffffffffffffffffff 28c67fb2a4b3b2c504b8883ce7208425 28c67fb2a4b3b2c504b8883ce7208425 ffffffffffffffffffffffffffffffff OK      OK
3000000000000000 011e71fc2a255c17 10000000000000011000000000000001 7b6703568bea9e2a3182dae3b2a99000 7b6703568bea9e2a3182dae3b2a99000 10000000000000011000000000000001 OK      OK
1111111111111111 a92a9a9991876002 11111111111111111111111111111111 d7236660f5c9ca453a2bc88479354d01 d7236660f5c9ca453a2bc88479354d01 11111111111111111111111111111111 OK      OK
0123456789ABCDEF 4c84ccc79a0e5972 11111111111111111111111111111111 380634d33dc9c612f86d0670b26531ba 380634d33dc9c612f86d0670b26531ba 11111111111111111111111111111111 OK      OK
1111111111111111 3c752489ecf3b9df 0123456789abcdef0123456789abcdef eddbd4b4d26d2051b91e8942c9a98969 eddbd4b4d26d2051b91e8942c9a98969 0123456789abcdef0123456789abcdef OK      OK
FEDCBA9876543210 649bfefed7c635db 0123456789abcdef0123456789abcdef 6e31bba9ba0ad1b8937f177578d0ec86 6e31bba9ba0ad1b8937f177578d0ec86 0123456789abcdef0123456789abcdef OK      OK
7CA110454A1A6E57 0eac175f06d64b43 01a1d6d03977674201a1d6d039776742 2ed1faff2c889f8963a17a837d9f1298 2ed1faff2c889f8963a17a837d9f1298 01a1d6d03977674201a1d6d039776742 OK      OK
0131D9619DC1376E b9d5b0954546ea02 5cd54ca83def57da5cd54ca83def57da 2862fe3d1f200bb039a3c8f2c45c6d44 2862fe3d1f200bb039a3c8f2c45c6d44 5cd54ca83def57da5cd54ca83def57da OK      OK
07A1133E4A0B2686 1bbdf27477bd347b 0248d43806f671720248d43806f67172 de05ce6ebe42a457f4c2a7e3d69bc864 de05ce6ebe42a457f4c2a7e3d69bc864 0248d43806f671720248d43806f67172 OK      OK
3849674C2602319E 39265c919bbb6298 51454b582ddf440a51454b582ddf440a 83885e9372f9f786c6ec5e8502a17386 83885e9372f9f786c6ec5e8502a17386 51454b582ddf440a51454b582ddf440a OK      OK
04B915BA43FEB5B6 a72b58bffc83cc6c 42fd443059577fa242fd443059577fa2 175779b150372a553969e790855a0440 175779b150372a553969e790855a0440 42fd443059577fa242fd443059577fa2 OK      OK
0113B970FD34F2CE e624f22580b2107d 059b5e0851cf143a059b5e0851cf143a f201622c4ff1c39bf45cfb8636ec0708 f201622c4ff1c39bf45cfb8636ec0708 059b5e0851cf143a059b5e0851cf143a OK      OK
0170F175468FB5E6 df27aef6116c4db0 0756d8e0774761d20756d8e0774761d2 cbaaa27d5e86850d3a42471407db2355 cbaaa27d5e86850d3a42471407db2355 0756d8e0774761d20756d8e0774761d2 OK      OK
43297FAD38E373FE 802779d02d3094d1 762514b829bf486a762514b829bf486a 7a598cd34ce4ea34d1ccd1c6c565b655 7a598cd34ce4ea34d1ccd1c6c565b655 762514b829bf486a762514b829bf486a OK      OK
07A7137045DA2A16 79b8c0ad914767ba 3bdd1190493728023bdd119049372802 e090aa274650f2811291b089055674ba e090aa274650f2811291b089055674ba 3bdd1190493728023bdd119049372802 OK      OK
04689104C2FD3B2F 1a6ca98308d45d1f 26955f6835af609a26955f6835af609a 20b2ca4887db7f531c05c0f865b4971f 20b2ca4887db7f531c05c0f865b4971f 26955f6835af609a26955f6835af609a OK      OK
37D06BB516CB7546 50d75f78588ceaf2 164d5e404f275232164d5e404f275232 4c458a79e14a5ba347ea2f3083c35b2f 4c458a79e14a5ba347ea2f3083c35b2f 164d5e404f275232164d5e404f275232 OK      OK
1F08260D1AC2465E c23190bc4bfa4574 6b056e18759f5cca6b056e18759f5cca 15b1a2cb9ec85501ee57cf712c4d843a 15b1a2cb9ec85501ee57cf712c4d843a 6b056e18759f5cca6b056e18759f5cca OK      OK
584023641ABA6176 0c92fd07e27f65d6 004bd6ef09176062004bd6ef09176062 78b93f61f96a1aaf49a0460a9792d6d0 78b93f61f96a1aaf49a0460a9792d6d0 004bd6ef09176062004bd6ef09176062 OK      OK
025816164629B007 1fd632a79fd63187 480d39006ee762f2480d39006ee762f2 6476e6c069674d4a9b3c1adec86052d4 6476e6c069674d4a9b3c1adec86052d4 480d39006ee762f2480d39006ee762f2 OK      OK
49793EBC79B3258F ba235548ef50bd1c 437540c8698f3cfa437540c8698f3cfa cf2f51cb1b752fcc46e97cb5a546f574 cf2f51cb1b752fcc46e97cb5a546f574 437540c8698f3cfa437540c8698f3cfa OK      OK
4FB05E1515AB73A7 0f002440be99b4d4 072d43a077075292072d43a077075292 404c68ec539b9db86cf4d4b07d57bcce 404c68ec539b9db86cf4d4b07d57bcce 072d43a077075292072d43a077075292 OK      OK
49E95D6D4CA229BF 731d038d1d35d9cd 02fe55778117f12a02fe55778117f12a d8c22249d6c46d923b87162a327c7b0a d8c22249d6c46d923b87162a327c7b0a 02fe55778117f12a02fe55778117f12a OK      OK
018310DC409B26D6 4ab1336f128aaebf 1d9d5c5018f728c21d9d5c5018f728c2 406e23f5bba2878e8992528995f004bf 406e23f5bba2878e8992528995f004bf 1d9d5c5018f728c21d9d5c5018f728c2 OK      OK
1C587F1C13924FEF f58028a087933b6f 305532286d6f295a305532286d6f295a 4d490dff959ed97d8366401e3cb1951b 4d490dff959ed97d8366401e3cb1951b 305532286d6f295a305532286d6f295a OK      OK
0101010101010101 fe74fd2d5530ebb1 0123456789abcdef0123456789abcdef a5c1dae669efe31fb97ea9750e7a3f79 a5c1dae669efe31fb97ea9750e7a3f79 0123456789abcdef0123456789abcdef OK      OK
1F1F1F1F0E0E0E0E 49e40ced6f189f18 0123456789abcdef0123456789abcdef 9d3b82d8d0d1741a609c987445d0b347 9d3b82d8d0d1741a609c987445d0b347 0123456789abcdef0123456789abcdef OK      OK
E0FEE0FEF1FEF1FE 76739aa03368c439 0123456789abcdef0123456789abcdef bba73c10b305ec96a064e7c27400db3b bba73c10b305ec96a064e7c27400db3b 0123456789abcdef0123456789abcdef OK      OK
0000000000000000 5f90b79fd3d9a198 ffffffffffffffffffffffffffffffff e511a43f5c0914ea0f6a2c35519e582b e511a43f5c0914ea0f6a2c35519e582b ffffffffffffffffffffffffffffffff OK      OK
FFFFFFFFFFFFFFFF b29a303de68dbc2e 00000000000000000000000000000000 341997842e88bf476761691da86bc0c1 341997842e88bf476761691da86bc0c1 00000000000000000000000000000000 OK      OK
0123456789ABCDEF b09e9cbc147e5995 00000000000000000000000000000000 f9977efef501f5fa4661dbc03eb9d56b f9977efef501f5fa4661dbc03eb9d56b 00000000000000000000000000000000 OK      OK
FEDCBA9876543210 0bb99ce8dd9226cd ffffffffffffffffffffffffffffffff fb894dab9fc1a3e13289d635605afdb4 fb894dab9fc1a3e13289d635605afdb4 ffffffffffffffffffffffffffffffff OK      OK