<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day19Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_plays_the_game()
    {
        $this->solveWithBinary(5)->shouldReturn(3);
    }

    function it_plays_the_game_pt2()
    {
        $this->solveWithLogicPt2(5)->shouldReturn(2);
        $this->solveWithLogicPt2(243)->shouldReturn(243);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day19.txt');
        $this->part1($input)->shouldReturn(1841611);
        $this->part2($input)->shouldReturn(1423634);
    }
}
