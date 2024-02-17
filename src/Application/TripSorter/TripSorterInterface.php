<?php

namespace Application\TripSorter;

interface TripSorterInterface
{
    /**
     * The sorting algorithm loop over all the provided baording cards
     * (via the  provided BoardingCardStoreInterface Instance)
     * and append every Boarding Card before or after the already partialy build journey.
     * This algorithm does not loop over the already appended boarding card on every iteration.
     *
     * @return void
     */
    public function sort();

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
