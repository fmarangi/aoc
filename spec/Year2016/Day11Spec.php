<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day11Spec extends ObjectBehavior
{
    private $example = 'The first floor contains a hydrogen-compatible microchip and a lithium-compatible microchip.
The second floor contains a hydrogen generator.
The third floor contains a lithium generator.
The fourth floor contains nothing relevant.';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_brings_all_items_to_the_fourth_floor()
    {
        $this->collectForAssembly($this->example)->shouldReturn(11);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day11.txt');
        $this->part1($input)->shouldReturn(31);
        $this->part2($input)->shouldReturn(55);
    }
}
