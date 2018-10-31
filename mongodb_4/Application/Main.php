<?php
namespace Application;

use DateTime;
use DateInterval;

/**
 * Used for initial view presented by index.php
 */
class Main extends Base
{

    /**
     * Builds URL for jQuery data tables to call
     * Calls getUrlParams() to generate valid start and end dates + limit
     * Returns values by reference
     *
     * @param string $start_date == YYYY-MM-DD format
     * @param string $end_date == YYYY-MM-DD format
     * @param int $limit
     * @return string $url = url string w/ params for start, end dates + limit
     */
    public static function buildUrl(&$start_date, &$end_date, &$limit)
    {
        self::getUrlParams($start_date, $end_date, $limit);
        return self::DEFAULT_URL . '?start_date=' . $start_date . '&end_date=' . $end_date . '&limit=' . $limit;
    }
    /**
     * Retrieves start + end dates + limit from URL
     * If values are not set, uses defaults
     * Calls calcDates() to generate valid start and end dates
     * Returns values by reference
     * Used by index.php and json.php
     *
     * @param string $start_date == YYYY-MM-DD format
     * @param string $end_date == YYYY-MM-DD format
     * @param int $limit
     * @return void
     */
    public static function getUrlParams(&$start_date, &$end_date, &$limit) : void
    {
        $start_date = (isset($_GET['start_date'])) ? strip_tags($_GET['start_date']) : date(self::DATE_FORMAT);
        $end_date   = (isset($_GET['end_date']))   ? strip_tags($_GET['end_date'])   : '';
        $limit      = (isset($_GET['limit']))      ? (int) $_GET['limit']            : self::DEFAULT_LIMIT;
        $end_date   = self::calcEndDate($start_date, $end_date);
    }
    /**
     * Produces end date string from starting date
     * If end_date is not blank, just returns it unchanged
     *
     * @param string $start_date
     * @param string $end_date
     * @return string $end_date
     */
    public static function calcEndDate($start_date, $end_date = '')
    {
        // end date
        if (!$end_date) {
            $startDateObj = new DateTime($start_date);
            $endDateObj = new DateTime('now');
            $endDateObj->add(new DateInterval(self::DEFAULT_END_DATE));
            $end_date = $endDateObj->format(self::DATE_FORMAT);
        }
        return $end_date;
    }
}
