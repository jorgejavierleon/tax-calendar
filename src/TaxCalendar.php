<?php

namespace Jleon\TaxCalendar;

use Exception;

class TaxCalendar
{
    public $format = 'd/m/Y';

    /**
     * @param Accountable $account
     * @param Tributable $tribute
     * @return array
     * @throws Exception
     */
    public function getDueDates(Accountable $account, Tributable $tribute)
    {
        $dates = $this->calendar($account, $tribute)->getDates();
        return $this->format($dates);
    }

    /**
     * @param $account
     * @param $tribute
     * @return mixed
     * @throws Exception
     */
    private function calendar($account, $tribute)
    {
        $calendarName = $this->sanitize($tribute->getCalendarClassId());
        $class = 'Jleon\TaxCalendar\Calendars\\' . $calendarName . 'Calendar';
        if (!class_exists($class)) {
            throw new Exception('No tribute calendar found ' . $class);
        }
        return new $class($account, $tribute);
    }

    /**
     * @param $calendarClassId
     * @return string
     * @throws Exception
     */
    private function sanitize($calendarClassId)
    {
        if(! $calendarClassId){
            throw new Exception('No calendar class id provided');
        }
        return ucfirst( strtolower($calendarClassId) );
    }

    /**
     * @param $dates
     * @return array
     */
    private function format($dates)
    {
        $format = $this->format;
        return array_map(function($date) use($format) {
            return $date->format($format);
        }, $dates);
    }
}
