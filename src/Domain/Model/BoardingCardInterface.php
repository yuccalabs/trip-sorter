<?php

namespace Domain\Model;

/**
 * Interface BoardingCardInterface
 * @package Domain\Model
 */
interface BoardingCardInterface
{
    /**
     * get the designation of the transportation service (flight n°, Train designation, ...)
     *
     * @return String
     */
    public function designation();

    /**
     * get the starting point
     *
     * @return String
     */
    public function from();

    /**
     * get the destination
     *
     * @return String
     */
    public function destination();

    /**
     * Provide Boarding Card Human readable instruction
     *
     * @return String
     */
    public function instruction();

    /**
     * Provide array serialized Boarding Card
     *
     * @return array
     */
    public function toArray();
}
