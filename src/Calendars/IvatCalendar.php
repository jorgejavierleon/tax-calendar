<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IvatCalendar extends Calendar
{
    /**
     * Iva formales trimestral
     *
     * Dentro de los 15 días del primer mes
     * siguiente al trimestre
     *
     * @return array
     */
    public function getDates()
    {
        return [
            Carbon::create(date('Y'), 1, 15, 0),
            Carbon::create(date('Y'), 4, 15, 0),
            Carbon::create(date('Y'), 7, 15, 0),
            Carbon::create(date('Y'), 10, 15, 0),
        ];
    }
}
