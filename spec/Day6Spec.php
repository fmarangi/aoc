<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day6Spec extends ObjectBehavior
{
    function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_get_the_highest()
    {
        $this->highest([0, 2, 7, 0])->shouldReturn(2);
        $this->highest([0, 2, 7, 7])->shouldReturn(2);
    }

    function it_should_calculate_next_cycle()
    {
        $this->next([0, 2, 7, 0])->shouldReturn([2, 4, 1, 2]);
        $this->next([2, 4, 1, 2])->shouldReturn([3, 1, 2, 3]);
        $this->next([3, 1, 2, 3])->shouldReturn([0, 2, 3, 4]);
        $this->next([0, 2, 3, 4])->shouldReturn([1, 3, 4, 1]);
        $this->next([1, 3, 4, 1])->shouldReturn([2, 4, 1, 2]);
    }

    function it_should_count_redistributions()
    {
        $this->debug([0, 2, 7, 0])->shouldReturn(5);
    }
}
