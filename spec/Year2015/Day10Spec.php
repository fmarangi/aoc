<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day10Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_converts_the_string()
    {
        $this->convert('1')->shouldReturn('11');
        $this->convert('21')->shouldReturn('1211');
        $this->convert('1211')->shouldReturn('111221');
        $this->convert('111221')->shouldReturn('312211');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day10.txt');
        $this->part1($input)->shouldReturn(252594);
        $this->part2($input)->shouldReturn(3579328);
    }
}
