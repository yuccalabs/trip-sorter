<?php

namespace spec\Application\BoardingCard;

use Application\Exception\BoardingCardTypeNotFoundException;
use Domain\Model\BusRide;
use Domain\Model\Flight;
use Domain\Model\TrainRide;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardingCardFactorySpec extends ObjectBehavior
{
    public function its_build_returns_bus_ride()
    {
        $json = new \stdClass();
        $json->type = BusRide::TYPE;
        $json->designation = 'BUS_X';
        $json->from = 'A';
        $json->destination = 'B';

        $this::build($json)->shouldReturnAnInstanceOf(BusRide::class);

        $this::build($json)->designation()->shouldBeEqualTo($json->designation);
        $this::build($json)->from()->shouldBeEqualTo($json->from);
        $this::build($json)->destination()->shouldBeEqualTo($json->destination);
        $this::build($json)->seat()->shouldBeEqualTo(null);
    }

    public function its_build_returns_train_ride()
    {
        $json = new \stdClass();
        $json->type = TrainRide::TYPE;
        $json->designation = 'TRAIN_X';
        $json->from = 'A';
        $json->destination = 'B';
        $json->seat = 'SEAT_X';

        $this::build($json)->shouldReturnAnInstanceOf(TrainRide::class);

        $this::build($json)->designation()->shouldBeEqualTo($json->designation);
        $this::build($json)->from()->shouldBeEqualTo($json->from);
        $this::build($json)->destination()->shouldBeEqualTo($json->destination);
        $this::build($json)->seat()->shouldBeEqualTo($json->seat);
    }

    public function its_build_returns_flight()
    {
        $json = new \stdClass();
        $json->type = Flight::TYPE;
        $json->designation = 'FLIGHT_X';
        $json->from = 'A';
        $json->destination = 'B';
        $json->gate = 'GATE_X';
        $json->seat = 'SEAT_X';
        $json->baggageDrop = 'BD_X';

        $this::build($json)->shouldReturnAnInstanceOf(Flight::class);
        $this::build($json)->designation()->shouldBeEqualTo($json->designation);
        $this::build($json)->from()->shouldBeEqualTo($json->from);
        $this::build($json)->destination()->shouldBeEqualTo($json->destination);
        $this::build($json)->gate()->shouldBeEqualTo($json->gate);
        $this::build($json)->seat()->shouldBeEqualTo($json->seat);
        $this::build($json)->baggageDrop()->shouldBeEqualTo($json->baggageDrop);
    }

    public function its_build_throws_BoardingCardTypeNotFoundException_on_invalid_type()
    {
        $json = new \stdClass();
        $json->type = 'undefined';

        $this->shouldThrow(
            new BoardingCardTypeNotFoundException('boarding card type not found', $json)
        )->duringBuild($json);
    }
}
