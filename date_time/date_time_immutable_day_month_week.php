<?php
class DateTest
{

    protected $today;
    protected $tomorrow;
    protected $week;
    protected $month;

    public function dayWeekMonth($date = NULL)
    {

        if (!$date) {
            $date = new DateTime();
        }
        $output = ['today' => $date->format('l, d M Y')];
        $seed = ['tomorrow' => 'P1D', 'week' => 'P1W', 'month' => 'P1M'];
        foreach ($seed as $key => $value) {
            $newDate = clone $date;
            $this->$key = $newDate->add(new DateInterval($value))->format('l, d M Y');
        }
        return $this;
    }
    public function output()
    {
        return <<<EOT
<table width="50%">
<tr><th>Today</th><td><?= $this->today; ?></td></tr>
<tr><th>Tomorrow</th><td><?= $this->tomorrow; ?></td></tr>
<tr><th>Next Week</th><td><?= $this->week; ?></td></tr>
<tr><th>Next Month</th><td><?= $this->month; ?></td></tr>
</table>
EOT;
    }
}
