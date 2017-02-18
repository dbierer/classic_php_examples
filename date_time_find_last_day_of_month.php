<?php
/**
 *  Returns string representing the last day of the month
 * 
 * @param array $date['year' => NNNN, 'month' => AAA]; year = 4 digits; month = 3 characters
 * @return string $lastDay
 */
function lastDayOfTheMonth($date)
{
    list('year' => $year, 'month' => $month) = $date;
    return date('l, t') . ' ' . $month . ' ' . $year;
}

/**
 * Gets sanitized input for year and month
 * Defaults to current year + current month
 * 
 * @return array $date['year' => NNNN, 'month' => NN]
 * 
 */
function getInput()
{
    $year  = (int) ($_GET['year']  ?? date('Y'));
    $month = strip_tags($_GET['month'] ?? date('M'));
    return ['year' => $year, 'month' => $month];
}

// find date of the last day of this month
$last = lastDayOfTheMonth(getInput());
echo "Last day of the month is $last\n";
