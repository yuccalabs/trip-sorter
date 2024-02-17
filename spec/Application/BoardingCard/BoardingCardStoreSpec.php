<?php

namespace spec\Application\BoardingCard;

use Domain\Model\BoardingCardInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardingCardStoreSpec extends ObjectBehavior
{
    public function it_should_have_no_boarding_cards()
    {
        $this->getBoardingCardCollection()->shouldHaveCount(0);
    }

    public function it_should_have_boarding_cards($boardingCard1, $boardingCard2)
    {
        $boardingCard1->beADoubleOf(BoardingCardInterface::class);
        $boardingCard2->beADoubleOf(BoardingCardInterface::class);

        $this->add($boardingCard1);
        $this->add($boardingCard2);

        $this->getBoardingCardCollection()->shouldHaveCount(2);
    }

    public function it_should_return_array_formated_boarding_cards($boardingCard1, $boardingCard2)
    {
        $boardingCard1->beADoubleOf(BoardingCardInterface::class);
        $boardingCard2->beADoubleOf(BoardingCardInterface::class);

        $boardingCard1->toArray()->willReturn(['A', 'B']);
        $boardingCard2->toArray()->willReturn(['B', 'C']);

        $this->add($boardingCard1);
        $this->add($boardingCard2);

        $this->toArray()->shouldReturn(
            [['A', 'B'], ['B', 'C']]
        );
    }

    public function it_should_return_human_readable_formatted_boarding_cards($boardingCard1, $boardingCard2)
    {
        $boardingCard1->beADoubleOf(BoardingCardInterface::class);
        $boardingCard2->beADoubleOf(BoardingCardInterface::class);

        $boardingCard1->instruction()->willReturn('from A to B.');
        $boardingCard2->instruction()->willReturn('from B to C.');

        $this->add($boardingCard1);
        $this->add($boardingCard2);

        $this->instructions()->shouldReturn(
            ['from A to B.', 'from B to C.']
        );
    }
}
