<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day5Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_password()
    {
        $this->getPassword('abc')->shouldReturn('18f47a30');
        $this->getSecondPassword('abc')->shouldReturn('05ace8e3');
    }

    private function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day5.txt');
        $this->part1($input)->shouldReturn('f77a0e6e');
        $this->part2($input)->shouldReturn('999828ec');
    }
}
