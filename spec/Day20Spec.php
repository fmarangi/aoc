<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day20Spec extends ObjectBehavior
{
    private $input = 'p=< 3,0,0>, v=< 2,0,0>, a=<-1,0,0>
p=< 4,0,0>, v=< 0,0,0>, a=<-2,0,0>';

    private $input2 = 'p=<-6,0,0>, v=< 3,0,0>, a=< 0,0,0>    
p=<-4,0,0>, v=< 2,0,0>, a=< 0,0,0>
p=<-2,0,0>, v=< 1,0,0>, a=< 0,0,0>
p=< 3,0,0>, v=<-1,0,0>, a=< 0,0,0>';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_should_solve_the_sample_puzzle()
    {
        $this->getClosest($this->input, 3)->shouldReturn(0);
        $this->getRemaining($this->input2, 3)->shouldReturn(1);
    }

    function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day20.txt');
        $this->part1($input)->shouldReturn(308);
        $this->part2($input)->shouldReturn(504);
    }
}
