<?php

namespace Application\BoardingCard;

use Domain\Model\BoardingCardInterface;

class BoardingCardStore implements BoardingCardStoreInterface
{
    /** @var \ArrayObject */
    private $boardingCardCollection;

    /**
     * BoardingCardStorage constructor.
     */
    public function __construct()
    {
        $this->boardingCardCollection = new \ArrayObject();
    }

    /**
     * @param BoardingCardInterface $boardingCard
     *
     * @return void
     */
    public function add(BoardingCardInterface $boardingCard)
    {
        return $this->boardingCardCollection->append($boardingCard);
    }

    /**
     * @return \ArrayObject
     */
    public function getBoardingCardCollection()
    {
        return $this->boardingCardCollection;
    }

    /**
     * @param $boardCardCollection
     */
    public function setBoardingCardCollection(array $boardCardCollection)
    {
        $this->boardingCardCollection = $boardCardCollection;
    }

    /**
     * Provide a serialized arrays of appended boarding cards
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function(BoardingCardInterface $boardingCard) {
            return $boardingCard->toArray();
        },
            (array)$this->boardingCardCollection
        );
    }

    /**
     * Provide human readable set of instructions to follow
     *
     * @return array
     */
    public function instructions()
    {
        return array_map(function(BoardingCardInterface $boardingCard) {
                return $boardingCard->instruction();
            },
            (array)$this->boardingCardCollection
        );
    }
}
