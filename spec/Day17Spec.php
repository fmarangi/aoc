<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day17Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_generate_the_sequence()
    {
        $this->spinlock(3, 0)->shouldReturn([0]);
        $this->spinlock(3, 1)->shouldReturn([0, 1]);
        $this->spinlock(3, 3)->shouldReturn([0, 2, 3, 1]);
        $this->spinlock(3, 4)->shouldReturn([0, 2, 4, 3, 1]);
        $this->spinlock(3, 5)->shouldReturn([0, 5, 2, 4, 3, 1]);
        $this->spinlock(3, 6)->shouldReturn([0, 5, 2, 4, 3, 6, 1]);
        $this->spinlock(3, 7)->shouldReturn([0, 5, 7, 2, 4, 3, 6, 1]);
        $this->spinlock(3, 8)->shouldReturn([0, 5, 7, 2, 4, 3, 8, 6, 1]);
        $this->spinlock(3, 9)->shouldReturn([0, 9, 5, 7, 2, 4, 3, 8, 6, 1]);
    }

    function it_should_get_the_value_after_2017()
    {
        $this->getValueAfter(3, 2017)->shouldReturn(638);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day17.txt');
        $this->part1($input)->shouldReturn(600);
        $this->part2($input)->shouldReturn(31220910);
    }
}
