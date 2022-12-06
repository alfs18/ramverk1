<?php

namespace Anax\WeatherController;

class Dates
{
    /**
     * Get previous dates.
     *
     * @param int $days the amount of days to go back.
     *
     * @return array all the dates.
     */
    public function getPastDates(int $days)
    {
        $dates = [];
        for ($x = 1; $x <= $days; $x++) {
            $d=strtotime("-$x Days");
            $date = date("Y-m-d", $d);
            $dates[] = $date;
        }
        return $dates;
    }
}
