<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day15Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_highest_score()
    {
        $ingredients = 'Butterscotch: capacity -1, durability -2, flavor 6, texture 3, calories 8
Cinnamon: capacity 2, durability 3, flavor -2, texture -1, calories 3';

        $this->getHighestScore($ingredients)->shouldReturn(62842880);
        $this->getHighestScore($ingredients, 500)->shouldReturn(57600000);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day15.txt');
        $this->part1($input)->shouldReturn(21367368);
        $this->part2($input)->shouldReturn(1766400);
    }
}
