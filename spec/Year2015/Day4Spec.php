<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_code()
    {
        $this->getCode('abcdef')->shouldReturn(609043);
        $this->getCode('pqrstuv')->shouldReturn(1048970);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day4.txt');
        $this->part1($input)->shouldReturn(346386);
        $this->part2($input)->shouldReturn(9958218);
    }
}
