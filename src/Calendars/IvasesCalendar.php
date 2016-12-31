<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvasesCalendar extends Calendar
{
    /**
     * Iva semestral para contribuyente especial
     *
     * @return array
     */
    public function getDates()
    {
        $days = $this->getSpecialDays(); //return an array of days [ 24, 19 ]
        $dates = [
            Carbon::create(date('Y'), 7, $days[0], 0),
            Carbon::create(date('Y') + 1, 1, $days[1], 0), //january next year
        ];
        return $dates;
    }

    /**
     * getSpecialDays
     *
     * @access private
     * @return void
     */
    private function getSpecialDays()
    {
        $lastRif = $this->getLastRifDig();
        $special_calendar = $this->specialCalendarForIva();
        foreach ($special_calendar as $calendar) {
            if (in_array($lastRif, $calendar[0])) {
                $days = [ $calendar[1][6], $calendar[1][0] ];
                break;
            }
        }
        return $days;
    }
}
