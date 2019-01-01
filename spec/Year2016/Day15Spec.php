<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day15Spec extends ObjectBehavior
{
    /** @var string */
    private $input = 'Disc #1 has 5 positions; at time=0, it is at position 4.
Disc #2 has 2 positions; at time=0, it is at position 1.';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_presses_the_button()
    {
        $this->pressButton($this->input)->shouldReturn(5);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day15.txt');
        $this->part1($input)->shouldReturn(16824);
        $this->part2($input)->shouldReturn(3543984);
    }
}
