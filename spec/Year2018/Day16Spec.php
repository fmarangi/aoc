<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day16Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_checks_the_matching_opcodes()
    {
        $this->getMatching('Before: [3, 2, 1, 1]
9 2 1 2
After:  [3, 2, 2, 1]')->shouldReturn(3);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day16.txt');
        $this->part1($input)->shouldReturn(624);
        $this->part2($input)->shouldReturn(584);
    }
}
