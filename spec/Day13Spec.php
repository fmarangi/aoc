<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day13Spec extends ObjectBehavior
{
    private $input = '0: 3
1: 2
4: 4
6: 4
';

    function it_is_initializable()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_calculate_the_severity()
    {
        $this->getSeverity($this->input)->shouldReturn(24);
    }

    function it_should_calculate_the_delay()
    {
        $this->getDelay($this->input)->shouldReturn(10);
    }

    function it_should_solve_the_puzzle()
    {
        $input = trim(file_get_contents(dirname(__DIR__) . '/input/day13.txt'));
        $this->part1($input)->shouldReturn(1904);
        $this->part2($input)->shouldReturn(3833504);
    }
}
