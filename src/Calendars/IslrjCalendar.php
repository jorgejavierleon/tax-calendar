<?php


namespace Jleon\TaxCalendar\Calendars;


class IslrjCalendar extends Calendar
{

    /**
     * Impuesto sobre la renta juridica
     *
     * Durante los tres meses posterior al cierre del
     * ejercicio fiscal correspondiente. Si cierra
     * el 31-12, seria 31-3 del siguiente año
     *
     * @return array
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()
                ->firstOfMonth()
                ->addMonth(3)
                ->endOfMonth()
        ];
    }
}
