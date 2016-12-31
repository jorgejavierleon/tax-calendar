<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvatesCalendar extends Calendar
{
    /**
     * Iva trimestral para contribuyente especial
     *
     * @return array
     */
    public function getDates()
    {
        $days = $this->getSpecialDays();
        $dates = [
            Carbon::create(date('Y'), 4, $days[0], 0),
            Carbon::create(date('Y'), 7, $days[1], 0),
            Carbon::create(date('Y'), 10, $days[2], 0)
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
                $days = [ $calendar[1][3], $calendar[1][6], $calendar[1][9] ];
                break;
            }
        }
        return $days;
    }
}
