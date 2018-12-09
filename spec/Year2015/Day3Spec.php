<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day3Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_delivers_the_presents()
    {
        $this->deliverPresents('>')->shouldReturn(2);
        $this->deliverPresents('^>v<')->shouldReturn(4);
        $this->deliverPresents('^v^v^v^v^v')->shouldReturn(2);
    }

    function it_delivers_the_presents_with_robosanta()
    {
        $this->deliverWithRobosanta('^v')->shouldReturn(3);
        $this->deliverWithRobosanta('^>v<')->shouldReturn(3);
        $this->deliverWithRobosanta('^v^v^v^v^v')->shouldReturn(11);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day3.txt');
        $this->part1($input)->shouldReturn(2572);
        $this->part2($input)->shouldReturn(2631);
    }
}
