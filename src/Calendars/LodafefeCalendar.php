<?php


namespace Jleon\TaxCalendar\Calendars;


class LodafefeCalendar extends Calendar
{

    /**
     * Lodafefe Estimada
     *
     * Dentro de los 190 días siguientes al cierre del ejercicio.
     * Si cierra el 31-12, seria 09-7 del siguiente año.
     *
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()
                ->addDays(190)
        ];
    }
}
