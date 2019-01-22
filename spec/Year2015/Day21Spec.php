<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day21Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_simulates_a_fight()
    {
        $this->fight([8, 5, 5], [12, 7, 2])->shouldReturn([8, 5, 5]);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day21.txt');
        $this->part1($input)->shouldReturn(78);
        $this->part2($input)->shouldReturn(148);
    }
}
