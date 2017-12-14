<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day10Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_apply_hash()
    {
        $this->apply([0, 1, 2, 3, 4], 0, 3)->shouldReturn([2, 1, 0, 3, 4]);
        $this->apply([2, 1, 0, 3, 4], 3, 4)->shouldReturn([4, 3, 0, 1, 2]);
        $this->apply([4, 3, 0, 1, 2], 1, 1)->shouldReturn([4, 3, 0, 1, 2]);
        $this->apply([4, 3, 0, 1, 2], 1, 5)->shouldReturn([3, 4, 2, 1, 0]);
    }

    function it_should_apply_lengths()
    {
        $this->factor([3, 4, 1, 5], 5)->shouldReturn(12);
    }
}
