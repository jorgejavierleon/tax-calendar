<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class RpvhCalendar extends Calendar
{
    /**
     * @return array
     */
    public function getDates()
    {
        for ($i = 1; $i < 13; $i++) {
            $date = Carbon::create(date('Y'), $i, 5, 0);
            $dates[] = $date;
        }
        return $dates;
    }
}
