<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day2Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_correct_checksum()
    {
        $this->checksum('5 1 9 5
7 5 3
2 4 6 8')->shouldReturn(18);
    }

    function it_finds_divisible_values()
    {
        $this->findDivisible([5, 9, 2, 8])->shouldReturn([8, 2]);
        $this->findDivisible([9, 4, 7, 3])->shouldReturn([9, 3]);
        $this->findDivisible([3, 8, 6, 5])->shouldReturn([6, 3]);
    }

    function it_sums_divisible_values()
    {
        $this->sumDivisible('5 9 2 8
9 4 7 3
3 8 6 5')->shouldReturn(9);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day2.txt');
        $this->part1($input)->shouldReturn(36174);
        $this->part2($input)->shouldReturn(244);
    }
}
