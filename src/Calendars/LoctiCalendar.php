<?php


namespace Jleon\TaxCalendar\Calendars;


class LoctiCalendar extends Calendar
{

    /**
     * Durante el segundo trimestre posterior al cierre del
     * ejercicio fiscal correspondiente. Si cierra
     * el 31-12, seria 30-6 del siguiente año
     *
     * @return array
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()
                ->firstOfMonth()
                ->addMonth(6)
                ->endOfMonth()
        ];
    }
}
