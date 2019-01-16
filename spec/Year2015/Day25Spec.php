<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day25Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_code()
    {
        $this->getCode(6, 6)->shouldReturn(27995004);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day25.txt');
        $this->part1($input)->shouldReturn(8997277);
    }
}
