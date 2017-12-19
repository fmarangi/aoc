<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day18Spec extends ObjectBehavior
{
    private $input = 'set a 1
add a 2
mul a a
mod a 5
snd a
set a 0
rcv a
jgz a -1
set a 1
jgz a -2';

    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_calculate_the_recovered_frequency()
    {
        $this->getRecoveredFrequency($this->input)->shouldReturn(4);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/day18.txt');
        $this->part1($input)->shouldReturn(3423);
    }
}
