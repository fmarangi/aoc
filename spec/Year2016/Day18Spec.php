<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day18Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_next_row()
    {
        $this->getNextRow('..^^.')->shouldReturn('.^^^^');
        $this->getNextRow('.^^^^')->shouldReturn('^^..^');
        $this->getNextRow('.^^.^.^^^^')->shouldReturn('^^^...^..^');
    }

    function it_calculates_the_safe_tiles()
    {
        $this->getSafe('.^^.^.^^^^', 10)->shouldReturn(38);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day18.txt');
        $this->part1($input)->shouldReturn(1961);
        $this->part2($input)->shouldReturn(20000795);
    }
}
