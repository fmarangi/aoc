<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day1Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_right_floor()
    {
        $this->getFloor('(())')->shouldReturn(0);
        $this->getFloor('()()')->shouldReturn(0);
        $this->getFloor('(((')->shouldReturn(3);
        $this->getFloor('(()(()(')->shouldReturn(3);
        $this->getFloor('())')->shouldReturn(-1);
        $this->getFloor('))(')->shouldReturn(-1);
        $this->getFloor(')))')->shouldReturn(-3);
        $this->getFloor(')())())')->shouldReturn(-3);
    }

    function it_enters_the_basement()
    {
        $this->enterBasement(')')->shouldReturn(1);
        $this->enterBasement('()())')->shouldReturn(5);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day1.txt');
        $this->part1($input)->shouldReturn(232);
        $this->part2($input)->shouldReturn(1783);
    }
}
