<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day25Spec extends ObjectBehavior
{
    private $input = 'Begin in state A.
Perform a diagnostic checksum after 6 steps.

In state A:
  If the current value is 0:
    - Write the value 1.
    - Move one slot to the right.
    - Continue with state B.
  If the current value is 1:
    - Write the value 0.
    - Move one slot to the left.
    - Continue with state B.

In state B:
  If the current value is 0:
    - Write the value 1.
    - Move one slot to the left.
    - Continue with state A.
  If the current value is 1:
    - Write the value 1.
    - Move one slot to the right.
    - Continue with state A.';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_parses_the_input()
    {
        $this->getStepCount($this->input)->shouldReturn(6);
        $this->getBegin($this->input)->shouldReturn('A');
        $this->getSteps($this->input)->shouldReturn([
            'A' => [[1, 1, 'B'], [0, -1, 'B']],
            'B' => [[1, -1, 'A'], [1, 1, 'A']],
        ]);
    }

    function it_calculates_the_checksum()
    {
        $this->getChecksum($this->input)->shouldReturn(3);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day25.txt');
        $this->part1($input)->shouldReturn(3145);
    }
}
