<?php

namespace Jleon\TaxCalendar;

interface Accountable
{
    public function getClosingDate();

    public function getLastRifDig();
}
