<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day13Spec extends ObjectBehavior
{
    private $input = '0: 3
1: 2
4: 4
6: 4';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_severity()
    {
        $this->getSeverity($this->input)->shouldReturn(24);
    }

    function it_calculates_the_delay()
    {
        $this->getDelay($this->input)->shouldReturn(10);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day13.txt');
        $this->part1($input)->shouldReturn(1904);
        $this->part2($input)->shouldReturn(3833504);
    }
}
