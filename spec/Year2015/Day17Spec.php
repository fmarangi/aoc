<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day17Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_combinations()
    {
        $this->getCombinations([20, 15, 10, 5, 5], 25)->shouldHaveCount(4);
        $this->getMininumCombinations([20, 15, 10, 5, 5], 25)->shouldHaveCount(3);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day17.txt');
        $this->part1($input)->shouldReturn(654);
        $this->part2($input)->shouldReturn(57);
    }
}
