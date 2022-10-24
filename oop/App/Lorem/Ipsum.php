<?php
namespace App\Lorem;

class Ipsum
{
    const API_URL = 'https://loripsum.net/api';
    /**
     * Makes request to Lorem Ipsum API
     *
     * @param array $msg : error messages
     * @return string $ipsum : returns lorem ipsum as HTML string
     */
    public function __invoke(array &$msg = []) : string
    {
        return file_get_contents(self::API_URL);
    }
}
