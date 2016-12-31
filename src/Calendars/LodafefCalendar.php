<?php


namespace Jleon\TaxCalendar\Calendars;


class LodafefCalendar extends Calendar
{

    /**
     * Dentro de los 120 días continuos siguientes al cierre del ejercicio.
     * Si cierra el 31-12, seria 30-4 del siguiente año.
     * Se paga all o la primera poción de tres
     * @return array
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()
                ->addDays(120)
        ];
    }
}
