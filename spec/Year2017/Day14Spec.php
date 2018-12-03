<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day14Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_count_used_squares()
    {
        $this->getUsedSquares('flqrgnkx')->shouldReturn(8108);
    }

    function it_should_count_the_regions()
    {
        $this->getRegions('flqrgnkx')->shouldReturn(1242);
    }

    function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day14.txt');
        $this->part1($input)->shouldReturn(8106);
        $this->part2($input)->shouldReturn(1164);
    }
}
