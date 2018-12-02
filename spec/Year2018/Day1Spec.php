<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day1Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_changes_the_frequency()
    {
        $this->frequencyChange("+1\n-2\n+3\n+1", 0)->shouldReturn(3);
    }

    function it_finds_duplicate_frequency()
    {
        $this->findDuplicate("+1\n-1")->shouldReturn(0);
        $this->findDuplicate("+3\n+3\n+4\n-2\n-4")->shouldReturn(10);
        $this->findDuplicate("-6\n+3\n+8\n+5\n-6")->shouldReturn(5);
        $this->findDuplicate("+7\n+7\n-2\n-7\n-4")->shouldReturn(14);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day1.in');
        $this->part1($input)->shouldReturn(516);
        $this->part2($input)->shouldReturn(71892);
    }
}
