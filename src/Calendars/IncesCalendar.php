<?php


namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IncesCalendar extends Calendar
{

    /**
     * @return array
     */
    public function getDates()
    {
        return [
            Carbon::create(date('Y'), 4, 5, 0),
            Carbon::create(date('Y'), 7, 5, 0),
            Carbon::create(date('Y'), 10, 5, 0),
        ];
    }
}