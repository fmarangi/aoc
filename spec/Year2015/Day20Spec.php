<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day20Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_all_divisors()
    {
        $this->getDivisors(9)->shouldReturn([1, 9, 3]);
        $this->getDivisors(8)->shouldReturn([1, 8, 2, 4]);
        $this->getDivisors(24)->shouldReturn([1, 24, 2, 12, 3, 8, 4, 6]);
    }

    function it_calculates_the_number_of_presents()
    {
        $this->getPresents(8)->shouldReturn(150);
        $this->getPresents(7)->shouldReturn(80);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day20.txt');
        $this->part1($input)->shouldReturn(665280);
        $this->part2($input)->shouldReturn(705600);
    }
}
