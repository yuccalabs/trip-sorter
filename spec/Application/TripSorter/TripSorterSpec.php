<?php

namespace spec\Application\TripSorter;

use Application\BoardingCard\BoardingCardStoreInterface;
use Domain\Model\BoardingCardInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TripSorterSpec extends ObjectBehavior
{
    public function it_sort_boarding_cards(
        BoardingCardStoreInterface $boardingCardStore,
        BoardingCardInterface $boardingCard1,
        BoardingCardInterface $boardingCard2,
        BoardingCardInterface $boardingCard3
    ) {
        $boardingCard1->from()->willReturn('C');
        $boardingCard1->destination()->willReturn('D');

        $boardingCard2->from()->willReturn('A');
        $boardingCard2->destination()->willReturn('B');

        $boardingCard3->from()->willReturn('B');
        $boardingCard3->destination()->willReturn('C');

        $boardingCardStore->add($boardingCard1);
        $boardingCardStore->add($boardingCard2);
        $boardingCardStore->add($boardingCard3);

        $boardingCardStore->getBoardingCardCollection()->willReturn(
            [$boardingCard1, $boardingCard2, $boardingCard3]
        );

        $boardingCardStore->setBoardingCardCollection([$boardingCard2, $boardingCard3, $boardingCard1])->shouldBeCalled();

        $this->beConstructedWith($boardingCardStore);

        $this->sort();
    }

    public function it_should_return_array_formated_boarding_cards(
        BoardingCardStoreInterface $boardingCardStore
    ) {
        $boardingCardStore->toArray()->willReturn([['A', 'B'], ['B', 'C']]);

        $this->beConstructedWith($boardingCardStore);

        $this->toArray()->shouldReturn([['A', 'B'], ['B', 'C']]);

    }

    public function it_should_return_human_readable_formatted_boarding_cards(
        BoardingCardStoreInterface $boardingCardStore
    ) {
        $boardingCardStore->instructions()->willReturn(['from A to B.', 'from B to C.']);

        $this->beConstructedWith($boardingCardStore);

        $this->instructions()->shouldReturn(['from A to B.', 'from B to C.']);
    }
}
