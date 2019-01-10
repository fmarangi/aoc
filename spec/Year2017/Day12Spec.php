<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day12Spec extends ObjectBehavior
{
    private $input = '0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_counts_the_connected_programs()
    {
        $this->countConnected($this->input)->shouldReturn(6);
    }

    function it_counts_the_connected_groups()
    {
        $this->countGroups($this->input)->shouldReturn(2);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day12.txt');
        $this->part1($input)->shouldReturn(283);
        $this->part2($input)->shouldReturn(195);
    }
}
