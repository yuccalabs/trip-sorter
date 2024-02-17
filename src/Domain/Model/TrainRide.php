<?php

namespace Domain\Model;

class TrainRide extends AbstractBoardingCard
{
    const TYPE = 'train';

    /**
     * {@inheritdoc}
     */
    public function instruction()
    {
        return sprintf(
            'Take train %s from %s to %s. Sit in seat %s',
            $this->designation(),
            $this->from(),
            $this->destination(),
            $this->seat()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            'type' => self::TYPE,
            'designation' => $this->designation(),
            'from' => $this->from(),
            'destination' => $this->destination(),
            'seat' => $this->seat()
        ];
    }
}
