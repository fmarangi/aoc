<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day7Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_runs_the_instructions()
    {
        $input = '123 -> x
456 -> y
x AND y -> d
x OR y -> e
x LSHIFT 2 -> f
y RSHIFT 2 -> g
NOT x -> h
NOT y -> i';
        $this->runInstructions($input)->shouldReturn([
            'x' => 123,
            'y' => 456,
            'd' => 72,
            'e' => 507,
            'f' => 492,
            'g' => 114,
            'h' => 65412,
            'i' => 65079,
        ]);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day7.txt');
        $this->part1($input)->shouldReturn(46065);
        $this->part2($input)->shouldReturn(14134);
    }
}
