<?php


namespace Jleon\TaxCalendar\Calendars;


class LodafefpCalendar extends Calendar
{

    /**
     * Dentro de los 120 días continuos siguientes al cierre del ejercicio.
     * porciones  en plazos de hasta 25 días continuos  de cada una.
     * Si la primera porción fue el 30-4, la segunda seria
     * el 25-5 y la tercera 19-6
     *
     * @return array
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()->addDays(120),
            $this->getClosingDate()->addDays(145),
            $this->getClosingDate()->addDays(170),
        ];
    }
}
