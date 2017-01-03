<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IslrtesCalendar extends Calendar
{
    /**
     * Impuesto sobre la renta estimada contribuyente especial
     * Si el cierre es 31-12 y el rif termina en 7, sería  13/06
     *
     * @return array
     */
    public function getDates()
    {
        $sixth_month_after_close = $this->getClosingDate()->firstOfMonth()->addMonth(6)->format('m');
        $day = $this->getSpecialDay($sixth_month_after_close);
        return [
            Carbon::create(date('Y'), $sixth_month_after_close, $day, 0)
        ];
    }

    /**
     * getSpecialDays
     *
     * @access private
     * @return void
     */
    private function getSpecialDay($sixth_month_after_close)
    {
        $lastRif = $this->getLastRifDig();
        $sixth = intval($sixth_month_after_close);

        $special_calendar = $this->specialCalendarForIslrt();
        foreach ($special_calendar as $calendar) {
            if (in_array($lastRif, $calendar[0])) {
                $day = $calendar[1][$sixth - 1];
                break;
            }
        }
        return $day;
    }
}
