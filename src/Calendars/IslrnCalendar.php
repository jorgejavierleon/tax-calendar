<?php


namespace Jleon\TaxCalendar\Calendars;

use Carbon\Carbon;

class IslrnCalendar extends Calendar
{

    /**
     * Impuesto sobre la renta naturales
     *
     * 31-3
     *
     * @return array
     */
    public function getDates()
    {
        return [ Carbon::create(date('Y'), 3, 31, 0) ];
    }
}
