<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

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

    private $parallel = 'snd 1
snd 2
snd p
rcv a
rcv b
rcv c
rcv d';

    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_calculate_the_recovered_frequency()
    {
        $this->getRecoveredFrequency($this->input)->shouldReturn(4);
    }

    public function it_should_run_parallel_programs()
    {
        $this->runPrograms($this->parallel)->shouldReturn(3);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day18.txt');
        $this->part1($input)->shouldReturn(3423);
        $this->part2($input)->shouldReturn(7493);
    }
}
