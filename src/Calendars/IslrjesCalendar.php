<?php

namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;

class IslrjesCalendar extends Calendar
{
    /**
     * Impuesto sobre la renta jurídicos contribuyente especial
     *
     * @return array
     */
    public function getDates()
    {
        if ($this->isRegularAccount()) {
            return [ $this->dateForRegularAccount() ];
        }

        return [$this->dateForIrregularAccount()];
    }

    /**
     * isRegularAccount
     *
     * La fecha de cierre es en diciembre
     * @access private
     * @return boolean
     */
    private function isRegularAccount()
    {
        return $this->getClosingDate()->format('m') === '12';
    }

    /**
     * dateForRegularAccount
     *
     * @access private
     * @return void
     */
    private function dateForRegularAccount()
    {
        $lastRif = $this->getLastRifDig();
        //Calendario especial para ISLR autoliquidación regular
        $special_calendar = $this->specialCalendarForIslrar();
        foreach ($special_calendar as $calendar) {
            if (in_array($lastRif, $calendar[0])) {
                $day = $calendar[1]['day'];
                $month = $calendar[1]['month'];
                break;
            }
        }
        return Carbon::create(date('Y'), $month, $day, 0);
    }

    private function dateForIrregularAccount()
    {
        $month = $this->getClosingDate()->startOfMonth()->addMonths(3)->format('m');
        $day = $this->getSpecialDay($month);
        return $this->getClosingDate()->startOfMonth()->addMonths(3)->day($day)->year(date('Y'));
    }

    /**
     * getSpecialDays
     *
     * @access private
     * @return void
     */
    private function getSpecialDay($month)
    {
        $lastRif = $this->getLastRifDig();
        $special_calendar = $this->specialCalendarForIslrai();
        foreach ($special_calendar as $calendar) {
            if (in_array($lastRif, $calendar[0])) {
                $day = $calendar[1][$month - 1];
                break;
            }
        }
        return $day;
    }
}
