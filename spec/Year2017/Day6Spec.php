<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day6Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_highest()
    {
        $this->highest([0, 2, 7, 0])->shouldReturn(2);
        $this->highest([0, 2, 7, 7])->shouldReturn(2);
    }

    function it_calculates_the_next_cycle()
    {
        $this->next([0, 2, 7, 0])->shouldReturn([2, 4, 1, 2]);
        $this->next([2, 4, 1, 2])->shouldReturn([3, 1, 2, 3]);
        $this->next([3, 1, 2, 3])->shouldReturn([0, 2, 3, 4]);
        $this->next([0, 2, 3, 4])->shouldReturn([1, 3, 4, 1]);
        $this->next([1, 3, 4, 1])->shouldReturn([2, 4, 1, 2]);
    }

    function it_counts_the_redistributions()
    {
        $this->debug([0, 2, 7, 0])->shouldReturn(5);
    }

    function it_calculates_the_loop_size()
    {
        $this->getLoopSize([0, 2, 7, 0])->shouldReturn(4);
    }

    public function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day6.txt');
        $this->part1($input)->shouldReturn(11137);
        $this->part2($input)->shouldReturn(1037);
    }
}
