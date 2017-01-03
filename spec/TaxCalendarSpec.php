<?php

namespace spec\Jleon\TaxCalendar;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaxCalendarSpec extends ObjectBehavior
{

    function let($account, $tribute)
    {
        $account->beADoubleOf('Jleon\TaxCalendar\Accountable');
        $tribute->beADoubleOf('Jleon\TaxCalendar\Tributable');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jleon\TaxCalendar\TaxCalendar');
    }

    /**
     * Seguro social obligatorio SSO
     *
     * Dentro de 5 los primeros días de cada mes
     */
    function it_gets_dates_for_sso($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("sso");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "05/01/$year", "05/02/$year", "05/03/$year", "05/04/$year",
            "05/05/$year", "05/06/$year", "05/07/$year", "05/08/$year",
            "05/09/$year", "05/10/$year", "05/11/$year", "05/12/$year",
        ]);
    }

    /**
     * Locti Ley orgánica de ciencia tecnología e información
     *
     * Durante el segundo trimestre posterior al cierre
     * del ejercicio fiscal correspondiente
     */
    function it_gets_dates_for_locti($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("locti");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "30/06/$year"
        ]);
    }

    /**
     * Inces
     *
     * Dentro de los primeros 5 días después
     * de vencido cada trimestre
     */
    function it_gets_dates_for_inces($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("inces");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "05/04/$year",
            "05/07/$year",
            "05/10/$year",
        ]);
    }

    /**
     * RPVH
     *
     * Dentro de 5 los primeros días de cada mes
     */
    function it_gets_dates_for_rpvh($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("rpvh");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "05/01/$year", "05/02/$year", "05/03/$year", "05/04/$year",
            "05/05/$year", "05/06/$year", "05/07/$year", "05/08/$year",
            "05/09/$year", "05/10/$year", "05/11/$year", "05/12/$year",
        ]);
    }

    /**
     * LOD
     *
     * Dentro de los 60 días continuos contados a partir
     * del cierre del ejercicio fiscal respectivo
     */
    function it_gets_dates_for_lod($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("lod");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "01/03/2017"
        ]);
    }

    /**
     * LODAFEF
     *
     * Dentro de los 120 días continuos contados a partir
     * del cierre del ejercicio fiscal respectivo
     */
    function it_gets_dates_for_lodafef($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("lodafef");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "30/04/2017"
        ]);
    }

    /**
     * Lodafef pagos parciales
     *
     * porciones  en plazos de hasta 25 días continuos  de cada una.
     * Si la primera porción fue el 30-4, la segunda
     * seria el 25-5 y la tercera 19-6
     *
     */
    function it_gets_dates_for_lodafefp($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("lodafefp");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "30/04/2017",
            "25/05/2017",
            "19/06/2017",
        ]);
    }

    /**
     * Lodafefe Estimada
     *
     * Dentro de los 190 días siguientes al cierre del ejercicio.
     * Si cierra el 31-12, seria 09-7 del siguiente año.
     *
     */
    function it_gets_dates_for_lodafefe($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("lodafefe");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "09/07/2017"
        ]);
    }

    /**
     * Lodafefep Estimada pagos parciales
     *
     * 2 porciones  en plazos de hasta 30 días continuos  de cada una.
     * Si la primera porción fue el 09-7, la segunda seria
     * el 08-8 y la tercera 07-9
     */
    function it_gets_dates_for_lodafefep($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("lodafefep");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "09/07/2017",
            "08/08/2017",
            "07/09/2017",
        ]);
    }

    /**
     * Fona
     *
     * Dentro de los 15 días continuos cada mes
     */
    function it_gets_dates_for_fona($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("fona");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "15/01/$year", "15/02/$year", "15/03/$year", "15/04/$year",
            "15/05/$year", "15/06/$year", "15/07/$year", "15/08/$year",
            "15/09/$year", "15/10/$year", "15/11/$year", "15/12/$year",
        ]);
    }

    /**
     * Iva
     *
     * Dentro de los 15 días continuos cada mes
     */
    function it_gets_dates_for_iva($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("iva");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "15/01/$year", "15/02/$year", "15/03/$year", "15/04/$year",
            "15/05/$year", "15/06/$year", "15/07/$year", "15/08/$year",
            "15/09/$year", "15/10/$year", "15/11/$year", "15/12/$year",
        ]);
    }

    /**
     * Iva Contribuyente especial
     *
     * Dentro de los 15 días continuos cada mes
     */
    function it_gets_dates_for_ivaes($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivaes");
        $account->getLastRifDig()->willReturn("0");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "18/01/$year", "23/02/$year", "17/03/$year", "26/04/$year",
            "17/05/$year", "26/06/$year", "19/07/$year", "23/08/$year",
            "19/09/$year", "24/10/$year", "17/11/$year", "26/12/$year",
        ]);

    }
    /**
     * Iva trimestral
     *
     * Dentro de los 15 días continuos del primer
     * mes siguiente al trimestre
     */
    function it_gets_dates_for_ivat($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivat");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "15/01/$year", // el correspondiente al ano anterior
            "15/04/$year",
            "15/07/$year",
            "15/10/$year"
        ]);
    }

    /**
     * Iva trimestral Contribuyente Especial
     *
     * Calendario Especial primer mes siguiente al trimestre
     */
    function it_gets_dates_for_ivates($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivates");
        $account->getLastRifDig()->willReturn("1");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "24/01/$year",
            "20/04/$year",
            "26/07/$year",
            "18/10/$year"
        ]);
    }

    /**
     * Iva semestral
     *
     * Dentro de los 15 días continuos del primer
     * mes siguiente al semestre
     */
    function it_gets_dates_for_ivas($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivas");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "15/01/$year", // el correspondiente al ano anterior
            "15/07/$year",
        ]);
    }

    /**
     * Iva semestral Contribuyente especial
     *
     * Calendario Especial primer mes siguiente al semestre
     */
    function it_gets_dates_for_ivases($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivases");
        $account->getLastRifDig()->willReturn("1");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "24/01/$year",
            "26/07/$year",
        ]);
    }

    /**
     * Iva retenciones primera quincena
     *
     * Calendario de contribuyente especial
     */
    function it_gets_dates_for_ivarpq($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivarpq");
        $account->getLastRifDig()->willReturn("0");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "18/01/$year", "23/02/$year", "17/03/$year", "26/04/$year",
            "17/05/$year", "26/06/$year", "19/07/$year", "23/08/$year",
            "19/09/$year", "24/10/$year", "17/11/$year", "26/12/$year",
        ]);
    }

    /**
     * Iva retenciones segunda quincena
     *
     * Calendario de contribuyente especial
     */
    function it_gets_dates_for_ivarsq($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("ivarsq");
        $account->getLastRifDig()->willReturn("6");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "04/01/$year", "07/02/$year", "03/03/$year", "07/04/$year",
            "04/05/$year", "07/06/$year", "07/07/$year", "07/08/$year",
            "05/09/$year", "06/10/$year", "03/11/$year", "07/12/$year",
        ]);
    }

    /**
     * ISLR Impuesto sobre la renta naturales
     *
     * 3 meses despues del cierre
     */
    function it_gets_dates_for_islrn($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrn");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "31/03/2017"
        ]);
    }

    /**
     * ISLR Impuesto sobre la renta juridicas
     *
     * 3 meses despues del cierre
     */
    function it_gets_dates_for_islrj($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrj");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "31/03/2017"
        ]);
    }

    /**
     * ISLRR Impuesto sobre la renta Retenciones
     *
     * 10 primeros dias de cada mes
     */
    function it_gets_dates_for_islrr($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("islrr");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "10/01/$year", "10/02/$year", "10/03/$year", "10/04/$year",
            "10/05/$year", "10/06/$year", "10/07/$year", "10/08/$year",
            "10/09/$year", "10/10/$year", "10/11/$year", "10/12/$year",
        ]);
    }

    /**
     * ISLRRES Impuesto sobre la renta Retenciones contribuyente especial
     *
     * Calendario de contribuyente especial
     */
    function it_gets_dates_for_islrres($account, $tribute)
    {
        $year = date('Y');
        $tribute->getCalendarClassId()->willReturn("islrres");
        $account->getLastRifDig()->willReturn("6");

        $this->getDueDates($account, $tribute)->shouldReturn([
            "06/01/$year", "09/02/$year", "07/03/$year", "11/04/$year",
            "08/05/$year", "09/06/$year", "11/07/$year", "09/08/$year",
            "07/09/$year", "10/10/$year", "08/11/$year", "12/12/$year",
        ]);
    }

    /**
     * Impuesto sobre la renta Estimada
     *
     * Dentro de la segunda quincena del sexto mes del ejercicio anual.
     * Si el cierre es el 31-12, el pago seria el 30-6.
     */
    function it_gets_dates_for_islrt($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrt");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "30/06/2017",
        ]);
    }

    /**
     * ISLRTES Impuesto sobre la renta Estimada contribuyente especial
     *
     * Calendario de contribuyente especial para el sexto
     * mes después del cierre
     */
    function it_gets_dates_for_islrtes($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrtes");
        $account->getLastRifDig()->willReturn("7");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "13/06/2017"
        ]);
    }

    /**
     * Impuesto sobre la renta estimada pagos parciales
     *
     *  6 porciones, cada mes despues del cierre. Si la pirmera porción
     *  el 30-6, la segunda sera el 31-7; la tercera, 31-8; la cuarta,
     *  30-9; la quinta, 31-10; y la sexta 30-11.
     */
    function it_gets_dates_for_islrtp($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrtp");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "30/06/2017",
            "31/07/2017",
            "31/08/2017",
            "30/09/2017",
            "31/10/2017",
            "30/11/2017",
        ]);
    }

    /**
     * Impuesto sobre la renta estimada pagos parciales contribuyente especial
     *
     * 6 porciones, cada mes despues del sexto del cierre. Según calendario especial
     */
    function it_gets_dates_for_islrtpes($account, $tribute)
    {
        $tribute->getCalendarClassId()->willReturn("islrtpes");
        $account->getLastRifDig()->willReturn("3");
        $account->getClosingDate()->willReturn(['month' => 12, 'day' => 31, 'year' => 2017]);

        $this->getDueDates($account, $tribute)->shouldReturn([
            "13/06/2017",
            "17/07/2017",
            "11/08/2017",
            "14/09/2017",
            "13/10/2017",
            "14/11/2017",
        ]);
    }
}
