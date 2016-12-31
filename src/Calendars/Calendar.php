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
            [ [0,5], [18, 23, 17, 26, 17, 26, 19, 23, 19, 24, 17, 26] ],
            [ [6,9], [19, 22, 20, 26, 17, 26, 19, 23, 19, 24, 17, 26] ],
            [ [3,7], [20, 21, 21, 24, 19, 22, 21, 21, 21, 20, 21, 21] ],
            [ [4,8], [23, 20, 22, 21, 22, 21, 25, 18, 22, 19, 22, 20] ],
            [ [1,2], [24, 17, 23, 20, 23, 20, 26, 17, 25, 18, 23, 19] ],
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
            [ [0,5], [03, 08, 02, 10, 02, 08, 06, 08, 04, 09, 02, 08] ],
            [ [6,9], [04, 07, 03, 07, 04, 07, 07, 07, 05, 06, 03, 07] ],
            [ [3,7], [05, 05, 06, 06, 05, 06, 10, 04, 06, 05, 07, 06] ],
            [ [4,8], [06, 03, 07, 05, 08, 05, 11, 03, 07, 04, 08, 05] ],
            [ [1,2], [10, 02, 08, 04, 09, 02, 12, 02, 08, 03, 09, 04] ],
        ];
    }
}
