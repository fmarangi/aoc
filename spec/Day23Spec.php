<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day23Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day23.txt');
        $this->part1($input)->shouldReturn(8281);
    }
}
