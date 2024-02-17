<?php

namespace Domain\Model;

class BusRide extends AbstractBoardingCard
{
    const TYPE = 'bus';

    /**
     * {@inheritdoc}
     */
    public function instruction()
    {
        return sprintf(
            'Take the %s bus from %s to %s. No seat assignment',
            $this->designation(),
            $this->from(),
            $this->destination()
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
            'destination' => $this->destination()
        ];
    }
}
