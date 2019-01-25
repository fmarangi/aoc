<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day22Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_wins_the_battle()
    {
        $this->winBattle([10, 250], [13, 8])->shouldReturn(226);
        $this->winBattle([10, 250], [14, 8])->shouldReturn(641);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day22.txt');
        $this->part1($input)->shouldReturn(1269);
        $this->part2($input)->shouldReturn(1309);
    }
}
