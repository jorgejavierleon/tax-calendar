<?php


namespace Jleon\TaxCalendar\Calendars;


use Carbon\Carbon;
use Jleon\TaxCalendar\Accountable;
use Jleon\TaxCalendar\Tributable;

abstract class Calendar
{
    /**
     * @var Tributable
     */
    private $tribute;
    /**
     * @var Accountable
     */
    private $account;

    /**
     * Calendar constructor.
     * @param Accountable $account
     * @param Tributable $tribute
     */
    public function __construct(Accountable $account, Tributable $tribute)
    {
        $this->tribute = $tribute;
        $this->account = $account;
    }

    /**
     * @return array
     */
    abstract public function getDates();

    /**
     * @return mixed
     */
    protected function getClosingDate()
    {
        $closing = $this->account->getClosingDate();
        $year = array_key_exists('year', $closing) ? $closing['year'] : date('Y');
        $month = $closing['month'];
        $day = $closing['day'];

        return Carbon::createFromDate($year, $month, $day)->subYear();
    }

    /**
     * getLastRifDig
     *
     */
    protected function getLastRifDig()
    {
        return $this->account->getLastRifDig();
    }

    /**
     * specialCalendarForIva
     *
     * @access protected
     * @return array
     */
    protected function specialCalendarForIva()
    {
        return [
            [ [0,5], ['18', '23', '17', '26', '17', '26', '19', '23', '19', '24', '17', '26'] ],
            [ [6,9], ['19', '22', '20', '26', '17', '26', '19', '23', '19', '24', '17', '26'] ],
            [ [3,7], ['20', '21', '21', '24', '19', '22', '21', '21', '21', '20', '21', '21'] ],
            [ [4,8], ['23', '20', '22', '21', '22', '21', '25', '18', '22', '19', '22', '20'] ],
            [ [1,2], ['24', '17', '23', '20', '23', '20', '26', '17', '25', '18', '23', '19'] ],
        ];
    }

    /**
     * specialCalendarForIvaSegundaQuincena
     * para retenciones de la segunda quicena
     *
     * @access protected
     * @return void
     */
    protected function specialCalendarForIvaSegundaQuincena()
    {
        return [
            [ [0,5], ['03', '08', '02', '10', '02', '08', '06', '08', '04', '09', '02', '08'] ],
            [ [6,9], ['04', '07', '03', '07', '04', '07', '07', '07', '05', '06', '03', '07'] ],
            [ [3,7], ['05', '05', '06', '06', '05', '06', '10', '04', '06', '05', '07', '06'] ],
            [ [4,8], ['06', '03', '07', '05', '08', '05', '11', '03', '07', '04', '08', '05'] ],
            [ [1,2], ['10', '02', '08', '04', '09', '02', '12', '02', '08', '03', '09', '04'] ],
        ];
    }

    /**
     * specialCalendarForIslr
     *
     * @access protected
     * @return void
     */
    protected function specialCalendarForIslr()
    {
        return [
            [ [0,5], ['05', '10', '06', '12', '05', '12', '10', '10', '06', '11', '07', '13'] ],
            [ [6,9], ['06', '09', '07', '11', '08', '09', '11', '09', '07', '10', '08', '12'] ],
            [ [3,7], ['10', '08', '08', '10', '09', '08', '12', '08', '08', '09', '09', '08'] ],
            [ [4,8], ['11', '07', '09', '07', '10', '07', '13', '07', '12', '06', '10', '07'] ],
            [ [1,2], ['12', '06', '10', '06', '11', '06', '14', '04', '13', '05', '13', '06'] ],
        ];
    }

    /**
     * specialCalendarFor islr estimada
     *
     * @access protected
     * @return void
     */
    protected function specialCalendarForIslrt()
    {
        return [
            [ [0,5], [11, 15, 9, 20, 10, 15, 13, 16, 12, 17, 10, 18] ],
            [ [6,9], [12, 14, 10, 18, 11, 14, 14, 15, 13, 16, 13, 15] ],
            [ [3,7], [13, 13, 13, 17, 12, 13, 17, 11, 14, 13, 14, 14] ],
            [ [4,8], [16, 10, 14, 12, 15, 12, 18, 10, 15, 11, 15, 13] ],
            [ [1,2], [17, 9, 15, 11, 16, 9, 19, 9, 18, 10, 16, 12] ],
        ];
    }
}
