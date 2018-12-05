<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day5Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_resulting_polymer()
    {
        $this->getPolymer('aabAAB')->shouldReturn('aabAAB');
        $this->getPolymer('abBA')->shouldReturn('');
        $this->getPolymer('abAB')->shouldReturn('abAB');
        $this->getPolymer('dabAcCaCBAcCcaDA')->shouldReturn('dabCBAcaDA');
    }

    function it_improves_the_polymer()
    {
        $this->getImprovedPolymer('dabAcCaCBAcCcaDA')->shouldReturn(4);
    }

    function it_solves_the_puzzle()
    {
        $this->part1('dabAcCaCBAcCcaDA')->shouldReturn(10);

        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day5.txt');
        $this->part1($input)->shouldReturn(10180);
        $this->part2($input)->shouldReturn(10180);
    }
}
