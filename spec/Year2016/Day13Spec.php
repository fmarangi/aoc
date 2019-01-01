<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day13Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_finds_the_shortest_path()
    {
        $this->findShortestPath(7, 4, 10)->shouldReturn(11);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day13.txt');
        $this->part1($input)->shouldReturn(92);
        $this->part2($input)->shouldReturn(124);
    }
}
