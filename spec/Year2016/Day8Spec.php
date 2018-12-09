<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day8Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_runs_the_instructions()
    {
        $instructions = [
            'rect 3x2',
            'rotate column x=1 by 1',
            'rotate row y=0 by 4',
            'rotate column x=1 by 1',
        ];
        $this->runInstructions($instructions, [7, 3])->shouldReturn('.#..#.#
#.#....
.#.....');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day8.txt');
        $this->part1($input)->shouldReturn(121);
        $this->part2($input)->shouldReturn('RURUCEOEIL');
    }
}
