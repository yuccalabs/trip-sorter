<?php

namespace Domain\Model;

class CabRide extends AbstractBoardingCard
{
    const TYPE = 'cab';

    /**
     * {@inheritdoc}
     */
    public function instruction()
    {
        return sprintf(
            'Take cab %s from %s to %s',
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
        ];
    }
}
