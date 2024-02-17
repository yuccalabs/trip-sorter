<?php

namespace Application\TripSorter;

use Application\BoardingCard\BoardingCardStoreInterface;

class TripSorter implements TripSorterInterface
{
    /** @var BoardingCardStoreInterface */
    private $boardingCardStore;

    /**
     * TripSorter constructor.
     * @param BoardingCardStoreInterface $boardingCardStore
     */
    public function __construct(BoardingCardStoreInterface $boardingCardStore)
    {
        $this->boardingCardStore = $boardingCardStore;
    }

    /**
     * {@inheritdoc}
     */
    public function sort()
    {
        $sortedCollection = [];
        $collection = (array) $this->boardingCardStore->getBoardingCardCollection();

        // set first element
        $sortedCollection[] = $collection[0];
        $firstSortedElement = $lastSortedElement = $collection[0];
        unset($collection[0]);

        while (! empty($collection)) {
            foreach ($collection as $key => $boardingCard) {
                if ($boardingCard->from() === $lastSortedElement->destination()) {
                    $sortedCollection[] = $boardingCard;
                    $lastSortedElement = $boardingCard;

                    unset($collection[$key]);
                    continue;
                }

                if ($boardingCard->destination() === $firstSortedElement->from()) {
                    array_unshift($sortedCollection, $boardingCard);
                    $firstSortedElement = $boardingCard;

                    unset($collection[$key]);
                    continue;
                }
            }
        }

        $this->boardingCardStore->setBoardingCardCollection($sortedCollection);
    }

    /**
     * {@inheritdoc}
     */
    public function instructions()
    {
        return $this->boardingCardStore->instructions();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->boardingCardStore->toArray();
    }
}
