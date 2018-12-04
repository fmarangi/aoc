<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day1Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_distance()
    {
        $this->getDistance('R2, L3')->shouldReturn(5);
        $this->getDistance('R2, R2, R2')->shouldReturn(2);
        $this->getDistance('R5, L5, R5, R3')->shouldReturn(12);
        $this->getDistance('R5, R5, R5, R5, R5, R5, R5, R5')->shouldReturn(0);
        $this->getDistance('L5, L5, L5, L5, L5, L5, L5, L5')->shouldReturn(0);
    }

    function it_calculates_the_location()
    {
        $this->getVisitedTwice('R8, R4, R4, R8')->shouldReturn(4);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day1.txt');
        $this->part1($input)->shouldReturn(243);
        $this->part2($input)->shouldReturn(142);
    }
}
