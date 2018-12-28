<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day9Spec extends ObjectBehavior
{
    private $input = 'London to Dublin = 464
London to Belfast = 518
Dublin to Belfast = 141';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_routes()
    {
        $this->getRoutes(['London', 'Dublin', 'Belfast'])->shouldHaveCount(6);
    }

    function it_calculates_the_shortest_distance()
    {
        $this->getShortestDistance($this->input)->shouldReturn(605);
    }

    function it_calculates_the_longest_distance()
    {
        $this->getLongestDistance($this->input)->shouldReturn(982);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day9.txt');
        $this->part1($input)->shouldReturn(251);
        $this->part2($input)->shouldReturn(898);
    }
}
