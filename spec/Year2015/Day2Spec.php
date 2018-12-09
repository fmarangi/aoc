<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day2Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_paper_surface()
    {
        $this->getPaperSurface('2x3x4')->shouldReturn(58);
        $this->getPaperSurface('1x1x10')->shouldReturn(43);
    }

    function it_calculates_the_ribbon_length()
    {
        $this->getRibbonLength('2x3x4')->shouldReturn(34);
        $this->getRibbonLength('1x1x10')->shouldReturn(14);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day2.txt');
        $this->part1($input)->shouldReturn(1606483);
        $this->part2($input)->shouldReturn(3842356);
    }
}
