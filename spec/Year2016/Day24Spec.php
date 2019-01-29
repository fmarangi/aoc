<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day24Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_finds_the_shortest_path()
    {
        $this->findShortestPath('###########
#0.1.....2#
#.#######.#
#4.......3#
###########')->shouldReturn(14);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day24.txt');
        $this->part1($input)->shouldReturn(460);
        $this->part2($input)->shouldReturn(668);
    }
}
