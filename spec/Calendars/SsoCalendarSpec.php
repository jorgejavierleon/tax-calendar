<?php

namespace spec\Jleon\TaxCalendar\Calendars;

use Jleon\TaxCalendar\Accountable;
use Jleon\TaxCalendar\Tributable;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SsoCalendarSpec extends ObjectBehavior
{
    function let(Accountable $account, Tributable $tribute)
    {
        $this->beConstructedWith($account, $tribute);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jleon\TaxCalendar\Calendars\SsoCalendar');
    }

}
