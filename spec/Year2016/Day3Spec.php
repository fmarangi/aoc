<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day3Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day3.txt');
        $this->part1($input)->shouldReturn(917);
        $this->part2($input)->shouldReturn(1649);
    }
}
