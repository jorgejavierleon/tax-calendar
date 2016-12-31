<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvaCalendar extends Calendar
{
    /**
     * Dentro de los 15 días de cada mes
     *
     * @return array
     */
    public function getDates()
    {
        for ($i = 1; $i < 13; $i++) {
            $date = Carbon::create(date('Y'), $i, 15, 0);
            $dates[] = $date;
        }
        return $dates;
    }
}
