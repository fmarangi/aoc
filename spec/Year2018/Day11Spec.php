<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day11Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_fuel_level()
    {
        $this->getFuelLevel(3, 5, 8)->shouldReturn(4);
        $this->getFuelLevel(122, 79, 57)->shouldReturn(-5);
        $this->getFuelLevel(217, 196, 39)->shouldReturn(0);
        $this->getFuelLevel(101, 153, 71)->shouldReturn(4);
    }

    function it_gets_the_total_power()
    {
        $this->getTotalPower(33, 45, 18)->shouldReturn(29);
        $this->getTotalPower(21, 61, 42)->shouldReturn(30);
    }

    function it_gets_the_largest_total_power()
    {
        $this->getLargestTotalPower(18)->shouldReturn(['33,45', 29]);
        $this->getLargestTotalPower(42)->shouldReturn(['21,61', 30]);
    }


    function it_gets_the_largest_total_power_with_size()
    {
        $this->getLargestTotalPowerWithSize(18)->shouldReturn(['90,269,16', 113]);
        $this->getLargestTotalPowerWithSize(42)->shouldReturn(['232,251,12', 119]);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day11.txt');
        $this->part1($input)->shouldReturn('20,34');
        $this->part2($input)->shouldReturn('90,57,15');
    }
}
