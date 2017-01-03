<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IslrtpesCalendar extends Calendar
{
    /**
     * Impuesto sobre la renta estimada pagos parciales contribuyente especial
     *
     * 6 porciones, cada mes despues del sexto del cierre. Según calendario especial
     *
     * @return array
     */
    public function getDates()
    {
        for ($i = 6; $i < 12; $i++) {
            $month = $this->getClosingDate()->firstOfMonth()->addMonth($i)->format('m');
            $day = $this->getSpecialDays($month);
            $dates[] = Carbon::create(date('Y'), $month, $day, 0);
        }
        return $dates;
    }

    /**
     * getSpecialDays
     *
     * @access private
     * @return void
     */
    private function getSpecialDays($month)
    {
        $lastRif = $this->getLastRifDig();
        $month = intval($month);

        $special_calendar = $this->specialCalendarForIslrt();
        foreach ($special_calendar as $calendar) {
            if (in_array($lastRif, $calendar[0])) {
                $day = $calendar[1][$month - 1];
                break;
            }
        }
        return $day;
    }
}
