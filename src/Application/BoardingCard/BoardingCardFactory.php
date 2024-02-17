<?php

namespace Application\BoardingCard;

use Application\Exception\BoardingCardTypeNotFoundException;
use Domain\Model\BoardingCardInterface;
use Domain\Model\BusRide;
use Domain\Model\Flight;
use Domain\Model\TrainRide;

class BoardingCardFactory
{
    /**
     * @param \stdClass $json
     *
     * @throws BoardingCardTypeNotFoundException
     *
     * @return BoardingCardInterface
     */
    public static function build($json)
    {
        switch ($json->type) {
            case BusRide::TYPE:
                return new BusRide(
                    $json->designation,
                    $json->from,
                    $json->destination
                );
            case Flight::TYPE:
                return new Flight(
                    $json->designation,
                    $json->from,
                    $json->destination,
                    $json->gate,
                    $json->seat,
                    $json->baggageDrop
                );
            case TrainRide::TYPE:
                return new TrainRide(
                    $json->designation,
                    $json->from,
                    $json->destination,
                    $json->seat
                );
            default:
                throw new BoardingCardTypeNotFoundException('boarding card type not found', $json);
        }
    }
}
