<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day17Spec extends ObjectBehavior
{
    private $example = 'x=495, y=2..7
y=7, x=495..501
x=501, y=3..7
x=498, y=2..4
x=506, y=1..2
x=498, y=10..13
x=504, y=10..13
y=13, x=498..504';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_counts_the_water_tiles()
    {
        $this->getWaterTiles($this->example)->shouldReturn(57);
    }

    function it_counts_the_water_tiles_after_the_spring_has_drained()
    {
        $this->getWaterTilesAfter($this->example)->shouldReturn(29);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day17.txt');
        $this->part1($input)->shouldReturn(31038);
        $this->part2($input)->shouldReturn(25250);
    }
}
