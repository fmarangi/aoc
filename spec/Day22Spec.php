<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day22Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_converts_the_grid()
    {
        $this->parseInput("..#\n#..\n...")->shouldReturn([
            -1 => [-1 => false, 0 => false, 1 => true],
            0  => [-1 => true, 0 => false, 1 => false],
            1  => [-1 => false, 0 => false, 1 => false],
        ]);
    }

    function it_runs_bursts_of_activity()
    {
        $this->work("..#\n#..\n...", 1)->shouldReturn(1);
        $this->work("..#\n#..\n...", 7)->shouldReturn(5);
        $this->work("..#\n#..\n...", 70)->shouldReturn(41);
        $this->work("..#\n#..\n...", 10000)->shouldReturn(5587);

        $this->work2("..#\n#..\n...", 100)->shouldReturn(26);
        $this->work2("..#\n#..\n...", 10000000)->shouldReturn(2511944);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day22.txt');
        $this->part1($input)->shouldReturn(5196);
        $this->part2($input)->shouldReturn(2511633);
    }
}
