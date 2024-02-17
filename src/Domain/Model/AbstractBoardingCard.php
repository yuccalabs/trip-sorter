<?php

namespace Domain\Model;

abstract class AbstractBoardingCard implements BoardingCardInterface
{
    /** @var String */
    private $designation;

    /** @var string */
    private $from;

    /** @var string */
    private $destination;

    /** @var String */
    private $seat;

    /**
     * @param String $designation
     * @param String $from
     * @param String $destination
     * @param String $seat
     */
    public function __construct($designation, $from, $destination, $seat = null)
    {
        $this->designation = $designation;
        $this->from = $from;
        $this->destination = $destination;
        $this->seat = $seat;
    }

    /**
     * @return String
     */
    public function designation()
    {
        return $this->designation;
    }

    /**
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function destination()
    {
        return $this->destination;
    }

    /**
     * @return null|String
     */
    public function seat()
    {
        return $this->seat;
    }
}
