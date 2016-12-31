<?php


namespace Jleon\TaxCalendar\Calendars;


class LodafefepCalendar extends Calendar
{

    /**
     * Lodafefep Estimada pagos parciales
     *
     * 2 porciones en plazos de hasta 30 días continuos de cada una.
     * Si la primera porción fue el 09-7, la segunda seria
     * el 08-8 y la tercera 07-9
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()->addDays(190),
            $this->getClosingDate()->addDays(220),
            $this->getClosingDate()->addDays(250)
        ];
    }
}
