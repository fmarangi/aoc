<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day6Spec extends ObjectBehavior
{
    private $example = '1, 1
1, 6
8, 3
3, 4
5, 5
8, 9';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_finds_the_largest_area()
    {
        $this->findLargestArea($this->example)->shouldReturn(17);
    }

    function it_finds_the_total_distance_less_than_x()
    {
        $this->findTotalDistanceLessThan($this->example, 32)->shouldReturn(16);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day6.txt');
        $this->part1($input)->shouldReturn(4186);
        $this->part2($input)->shouldReturn(45509);
    }
}
