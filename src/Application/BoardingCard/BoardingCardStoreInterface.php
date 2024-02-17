<?php

namespace Application\BoardingCard;

use Domain\Model\BoardingCardInterface;

/**
 * Interface BoardingCardStoreInterface
 * @package Application\BoardingCard
 */
interface BoardingCardStoreInterface
{
    /**
     * @param BoardingCardInterface $boardingCard
     *
     * @return void
     */
    public function add(BoardingCardInterface $boardingCard);

    /**
     * @return \ArrayObject
     */
    public function getBoardingCardCollection();

    /**
     * @param array $boardingCardCollection
     */
    public function setBoardingCardCollection(array $boardingCardCollection);

    /**
     * Provide Boarding Card Human readable instruction
     *
     * @return array
     */
    public function instructions();

    /**
     * Provide array serialized Boarding Card
     *
     * @return array
     */
    public function toArray();
}
