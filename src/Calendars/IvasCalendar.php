<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvasCalendar extends Calendar
{
    /**
     * Iva formales semestral
     *
     * Dentro de los 15 días del primer mes
     * siguiente al semestre
     *
     * @return array
     */
    public function getDates()
    {
        return [
            Carbon::create(date('Y'), 7, 15, 0)
        ];
    }
}
