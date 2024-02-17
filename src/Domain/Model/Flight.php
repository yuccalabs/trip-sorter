<?php

namespace Domain\Model;

class Flight extends AbstractBoardingCard
{
    const TYPE = 'flight';

    /** @var int */
    private $gate;

    /** @var String|null */
    private $baggageDrop;

    /**
     * @param String $designation
     * @param String $from
     * @param String $destination
     * @param int    $gate
     * @param String $seat
     * @param null   $baggageDrop
     */
    public function __construct($designation, $from, $destination, $gate, $seat, $baggageDrop = null)
    {
        parent::__construct($designation, $from, $destination, $seat);

        $this->gate = $gate;
        $this->baggageDrop = $baggageDrop;
    }

    /**
     * @return int
     */
    public function gate()
    {
        return $this->gate;
    }

    /**
     * @return String
     */
    public function baggageDrop()
    {
        return $this->baggageDrop;
    }

    /**
     * @return String
     */
    private function baggageDropInstruction()
    {
        if (! $this->baggageDrop) {
            return 'Baggage will we automatically transferred from your last leg.';
        }

        return sprintf(
            'Baggage drop at ticket counter %s.',
            $this->baggageDrop
        );
    }

    /**
     * {@inheritdoc}
     */
    public function instruction()
    {
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, seat %s. %s',
            $this->from(),
            $this->designation(),
            $this->destination(),
            $this->gate(),
            $this->seat(),
            $this->baggageDropInstruction()
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
            'gate' => $this->gate(),
            'seat' => $this->seat(),
            'baggageDrop' => $this->baggageDrop()
        ];
    }
}
