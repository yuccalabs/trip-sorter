<?php

namespace spec\Domain\Model;

use Domain\Model\BusRide;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BusRideSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'BUS_X',
            'A',
            'B'
        );
    }

    function it_build_human_readable_instruction()
    {
        $this->instruction()->shouldReturn('Take the BUS_X bus from A to B. No seat assignment');
    }

    function its_toArray_does_return_array_serialized_boarding_card()
    {
        $this->toArray()->shouldReturn(
            [
                'type' => BusRide::TYPE,
                'designation' => 'BUS_X',
                'from' => 'A',
                'destination' => 'B'
            ]
        );
    }
}
