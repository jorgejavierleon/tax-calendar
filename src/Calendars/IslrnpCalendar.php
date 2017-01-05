<?php


namespace Jleon\TaxCalendar\Calendars;

use Carbon\Carbon;

class IslrnpCalendar extends Calendar
{

    /**
     * Impuesto sobre la renta naturales pagos paricales
     *
     * 31/03, 20/04, 05/05
     *
     * @return array
     */
    public function getDates()
    {
        return [
            Carbon::create(date('Y'), 3, 31, 0),
            Carbon::create(date('Y'), 4, 20, 0),
            Carbon::create(date('Y'), 5, 05, 0),
        ];
    }
}
