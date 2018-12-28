<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day14Spec extends ObjectBehavior
{
    private $input = 'Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.
Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds.';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_winning_distance()
    {
        $this->getWinningDistance($this->input, 1000)->shouldReturn(1120);
    }

    function it_gets_the_winning_score()
    {
        $this->getWinningScore($this->input, 1000)->shouldReturn(689);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day14.txt');
        $this->part1($input)->shouldReturn(2696);
        $this->part2($input)->shouldReturn(1084);
    }
}
