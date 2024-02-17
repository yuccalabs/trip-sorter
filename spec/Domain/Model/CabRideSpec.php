<?php

namespace spec\Domain\Model;

use Domain\Model\CabRide;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CabRideSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'CAB_X',
            'A',
            'B'
        );
    }

    function it_build_human_readable_instruction()
    {
        $this->instruction()->shouldReturn('Take train TRAIN_X from A to B.');
    }

    function its_toArray_does_return_array_serialized_boarding_card()
    {
        $this->toArray()->shouldReturn(
            [
                'type' => CabRide::TYPE,
                'designation' => 'TRAIN_X',
                'from' => 'A',
                'destination' => 'B'
            ]
        );
    }
}
