<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day23Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_runs_the_instructions()
    {
        $this->runInstructions('cpy 2 a
tgl a
tgl a
tgl a
cpy 1 a
dec a
dec a')->shouldHaveKeyWithValue('a', 3);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day23.txt');
        $this->part1($input)->shouldReturn(12800);
        $this->part2($input)->shouldReturn(479009360);
    }
}
