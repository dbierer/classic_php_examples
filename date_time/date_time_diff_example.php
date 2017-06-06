<?php
function daysDiff($diff)
{
    return ($diff->invert) ? -1 * $diff->days : $diff->days;
}
function pastPresentFuture($days)
{
    $result = 'Same';
    if ($days < 0) {
        $result = 'Past';
    } elseif ($days > 0) {
        $result = 'Future';
    } else {
        $result = 'Same';
    }
    return $result;
}
$dateString = '2016-01-01';
$now  = new DateTime('now');
$exp  = new DateTime($dateString);
$days = daysDiff($now->diff($exp));
echo $now->format('Y-m-d') . ':' . $exp->format('Y-m-d') . PHP_EOL;
echo 'Days Difference: ' . $days . PHP_EOL;
echo pastPresentFuture($days) . ' Date' . PHP_EOL;
echo PHP_EOL;

$dateString = '2018-01-01';
$now  = new DateTime('now');
$exp  = new DateTime($dateString);
$days = daysDiff($now->diff($exp));
echo $now->format('Y-m-d') . ':' . $exp->format('Y-m-d') . PHP_EOL;
echo 'Days Difference: ' . $days . PHP_EOL;
echo pastPresentFuture($days) . ' Date' . PHP_EOL;
echo PHP_EOL;
