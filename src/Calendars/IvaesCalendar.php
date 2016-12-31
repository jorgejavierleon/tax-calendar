<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvaesCalendar extends Calendar
{
    /**
     * Iva para contribuyente especial
     *
     * @return array
     */
    public function getDates()
    {
        $days = $this->getSpecialDays();
        for ($i = 1; $i < 13; $i++) {
            $date = Carbon::create(date('Y'), $i, $days[$i - 1], 0);
            $dates[] = $date;
        }
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
                $days = $calendar[1];
                break;
            }
        }
        return $days;
    }
}
