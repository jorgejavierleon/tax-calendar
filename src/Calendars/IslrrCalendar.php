<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IslrrCalendar extends Calendar
{
    /**
     * Impuesto sobre la renta retenciones
     * Dentro de los 10 días de cada mes
     *
     * @return array
     */
    public function getDates()
    {
        for ($i = 1; $i < 13; $i++) {
            $date = Carbon::create(date('Y'), $i, 10, 0);
            $dates[] = $date;
        }
        return $dates;
    }
}
