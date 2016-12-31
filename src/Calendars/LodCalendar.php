<?php


namespace Jleon\TaxCalendar\Calendars;


class LodCalendar extends Calendar
{

    /**
     * Dentro de los 60 días continuos contados a partir del cierre del
     * ejercicio fiscal respectivo. Si cierra el 31-12,
     * seria 28-2 del siguiente año
     *
     * @return array
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()
                ->addDays(60)
        ];
    }
}
