<?php


namespace Jleon\TaxCalendar\Calendars;


class IslrtCalendar extends Calendar
{

    /**
     * Impuesto sobre la renta estimada
     *
     * Dentro de la segunda quincena del sexto mes del ejercicio anual.
     * Si el cierre es el 31-12, el pago seria el 30-6.
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
