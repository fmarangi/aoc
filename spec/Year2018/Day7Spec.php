<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day7Spec extends ObjectBehavior
{
    private $example = 'Step C must be finished before step A can begin.
Step C must be finished before step F can begin.
Step A must be finished before step B can begin.
Step A must be finished before step D can begin.
Step B must be finished before step E can begin.
Step D must be finished before step E can begin.
Step F must be finished before step E can begin.';

    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_correct_order()
    {
        $this->getOrder($this->example)->shouldReturn('CABDFE');
    }

    function it_orders_the_steps_using_workers()
    {
        $this->orderWithWorkers($this->example, 2, 0)->shouldReturn(15);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day7.txt');
        $this->part1($input)->shouldReturn('BFGKNRTWXIHPUMLQVZOYJACDSE');
        $this->part2($input)->shouldReturn(1163);
    }
}
