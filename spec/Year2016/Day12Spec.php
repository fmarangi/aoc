<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day12Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_value_of_register_a()
    {
        $this->getValueOfA('cpy 41 a
inc a
inc a
dec a
jnz a 2
dec a')->shouldReturn(42);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day12.txt');
        $this->part1($input)->shouldReturn(318117);
        $this->part2($input)->shouldReturn(9227771);
    }
}
