<?php

namespace spec\Domain\Model;

use Domain\Model\Flight;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FlightSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'FLIGHT_X',
            'A',
            'B',
            'GATE_X',
            'SEAT_X',
            'BAGGAGE_DROP_NBR'
        );
    }

    function it_build_human_readable_instruction()
    {
        $this->instruction()->shouldReturn(
            'From A, take flight FLIGHT_X to B. Gate GATE_X, seat SEAT_X. Baggage drop at ticket counter BAGGAGE_DROP_NBR.'
        );
    }

    function it_build_human_readable_instruction_for_automatic_baggage_transfer()
    {
        $this->beConstructedWith('FLIGHT_X', 'A', 'B', 'GATE_X', 'SEAT_X');

        $this->instruction()->shouldReturn(
            'From A, take flight FLIGHT_X to B. Gate GATE_X, seat SEAT_X. Baggage will we automatically transferred from your last leg.'
        );
    }

    function its_toArray_does_return_array_serialized_boarding_card()
    {
        $this->toArray()->shouldReturn(
            [
                'type' => Flight::TYPE,
                'designation' => 'FLIGHT_X',
                'from' => 'A',
                'destination' => 'B',
                'gate' => 'GATE_X',
                'seat' => 'SEAT_X',
                'baggageDrop' => 'BAGGAGE_DROP_NBR'
            ]
        );
    }
}

