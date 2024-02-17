<?php

namespace spec\Domain\Model;

use Domain\Model\TrainRide;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrainRideSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'TRAIN_X',
            'A',
            'B',
            'SEAT_X'
        );
    }

    function it_build_human_readable_instruction()
    {
        $this->instruction()->shouldReturn('Take train TRAIN_X from A to B. Sit in seat SEAT_X');
    }

    function its_toArray_does_return_array_serialized_boarding_card()
    {
        $this->toArray()->shouldReturn(
            [
                'type' => TrainRide::TYPE,
                'designation' => 'TRAIN_X',
                'from' => 'A',
                'destination' => 'B',
                'seat' => 'SEAT_X'
            ]
        );
    }
}
