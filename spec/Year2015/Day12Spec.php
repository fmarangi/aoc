<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day12Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_sum()
    {
        $this->getSum('[1,2,3]')->shouldReturn(6);
        $this->getSum('{"a":2,"b":4}')->shouldReturn(6);
        $this->getSum('[[[3]]]')->shouldReturn(3);
        $this->getSum('{"a":{"b":4},"c":-1}')->shouldReturn(3);
        $this->getSum('{"a":[-1,1]}')->shouldReturn(0);
        $this->getSum('[-1,{"a":1}]')->shouldReturn(0);
        $this->getSum('[]')->shouldReturn(0);
        $this->getSum('{}')->shouldReturn(0);
    }

    function it_calculates_the_sum_without_red()
    {
        $this->getSumWithoutRed('[1,2,3]')->shouldReturn(6);
        $this->getSumWithoutRed('[1,{"c":"red","b":2},3]')->shouldReturn(4);
        $this->getSumWithoutRed('{"d":"red","e":[1,2,3,4],"f":5}')->shouldReturn(0);
        $this->getSumWithoutRed('[1,"red",5]')->shouldReturn(6);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day12.txt');
        $this->part1($input)->shouldReturn(156366);
        $this->part2($input)->shouldReturn(96852);
    }
}
