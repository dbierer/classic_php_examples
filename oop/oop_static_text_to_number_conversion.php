<?php
/**
 * Generates number to (English) text and text to number
 * Only works up to 999,999
 */
class TextNum
{
    const MAX_LEN         = 6;   // max size handled

    protected static $numbers = array(
             0 => 'zero',
             1 => 'one',
             2 => 'two',
             3 => 'three',
             4 => 'four',
             5 => 'five',
             6 => 'six',
             7 => 'seven',
             8 => 'eight',
             9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
           100 => 'hundred',
          1000 => 'thousand',
    );

    public static function num2text($num)
    {
        $temp = '';
        $str  = sprintf('%0' . self::MAX_LEN . 's', $num);
        $str  = substr($str, 0, self::MAX_LEN);
        // assume max $num == 999999
        if (strlen($str) == 6) {
            $temp .= self::handleTriplet(substr($str, 0, 3));
            $temp .= ' ' . self::$numbers[1000];
            $temp .= ' ' . self::handleTriplet(substr($str, 3, 3));
        }
        return trim($temp);
    }

    protected static function handleTriplet($str)
    {
        $temp = '';
        $str = substr($str, 0, 3);
        if (substr($str, 0, 1) !== '0') {
            $temp .= self::$numbers[(int) substr($str, 0, 1)] . ' ' . self::$numbers[100] . ' ';
        }
        if (((int) substr($str, 1, 1)) >= 2) {
            $temp .= self::$numbers[((int) substr($str, 1, 1)) * 10] . ' ';
            if ((int) substr($str, 2, 1) !== 0)
                $temp .= self::$numbers[(int) substr($str, 2, 1)] . ' ';
        } else {
            if ((int) substr($str, 1, 2) !== 0)
                $temp .= self::$numbers[(int) substr($str, 1, 2)] . ' ';
        }
        return trim($temp);
    }

    public static function text2num($text)
    {
        $words = str_word_count($text, 1);
        $numeric = array();
        foreach ($words as $key => $number) {
            $numeric[] = array_search($number, self::$numbers);
        }
        $temp = array();
        $done = FALSE;
        $pos = count($numeric);
        $total  = 0;
        while (!$done && $pos--) {
            $current = $numeric[$pos];
            if ($current < 20) {
                if (isset($numeric[$pos -1])) {
                    if ($numeric[$pos -1] > 20 && $numeric[$pos -1] < 100) {
                        $current += $numeric[$pos -1];
                        $pos--;
                    }
                }
            }
            $temp[] = $current;
        }
        // do 100s pass
        $temp = self::powerPass($temp, 100);
        // do 1000s pass
        $temp = self::crunch($temp, 1000);
        $temp = self::powerPass($temp, 1000);
        // do 10000s pass
        $temp = self::crunch($temp, 1000000);
        $temp = self::powerPass($temp, 1000000);
        return array_sum($temp);
    }
    protected static function crunch($numeric, $power)
    {
        $temp = array();
        $sub  = 0;
        foreach ($numeric as $value) {
            if ($value >= $power) {
                $temp[] = $sub;
                $temp[] = $value;
                $sub    = 0;
            } else {
                $sub += $value;
            }
        }
        $temp[] = $sub;
        return $temp;
    }
    protected static function powerPass($temp, $power)
    {
        $numeric = array_reverse($temp);
        $done = FALSE;
        $pos = count($numeric);
        $temp = array();
        while (!$done && $pos--) {
            $current = $numeric[$pos];
            if ($current == $power) {
                if (isset($numeric[$pos - 1])) {
                    $current = $numeric[$pos - 1] * $power;
                    $pos--;
                }
            }
            $temp[] = $current;
        }
        return $temp;
    }
}
