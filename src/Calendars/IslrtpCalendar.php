<?php


namespace Jleon\TaxCalendar\Calendars;


class IslrtpCalendar extends Calendar
{

    /**
     * Impuesto sobre la renta estimada pagos parciales
     *
     *  6 porciones, cada mes despues del cierre. Si la pirmera porción
     *  el 30-6, la segunda sera el 31-7; la tercera, 31-8; la cuarta,
     *  30-9; la quinta, 31-10; y la sexta 30-11.
     */
    public function getDates()
    {
        return [
            $this->getClosingDate()->firstOfMonth()->addMonth(6)->endOfMonth(),
            $this->getClosingDate()->firstOfMonth()->addMonth(7)->endOfMonth(),
            $this->getClosingDate()->firstOfMonth()->addMonth(8)->endOfMonth(),
            $this->getClosingDate()->firstOfMonth()->addMonth(9)->endOfMonth(),
            $this->getClosingDate()->firstOfMonth()->addMonth(10)->endOfMonth(),
            $this->getClosingDate()->firstOfMonth()->addMonth(11)->endOfMonth()
        ];
    }
}
