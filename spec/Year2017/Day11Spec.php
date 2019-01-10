<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day11Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_distance()
    {
        $this->distance(explode(',', 'ne,ne,ne'))->shouldReturn(3);
        $this->distance(explode(',', 'ne,ne,sw,sw'))->shouldReturn(0);
        $this->distance(explode(',', 'ne,ne,s,s'))->shouldReturn(2);
        $this->distance(explode(',', 'se,sw,se,sw,sw'))->shouldReturn(3);
        $this->distance(explode(',', 'n,n,s'))->shouldReturn(1);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day11.txt');
        $this->part1($input)->shouldReturn(794);
        $this->part2($input)->shouldReturn(1524);
    }
}
