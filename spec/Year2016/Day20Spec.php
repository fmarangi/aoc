<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day20Spec extends ObjectBehavior
{
    private $input = '5-8
0-2
4-7
6-7';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_lowest_allowed_ip()
    {
        $this->getLowestAllowedIp($this->input)->shouldReturn(3);
    }

    function it_simplifies_the_rules()
    {
        $this->simplify($this->input)->shouldReturn([[0, 2], [4, 8]]);
    }

    function it_gets_the_allowed_ips()
    {
        $this->getAllowed($this->input)->shouldReturn(4294967288);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day20.txt');
        $this->part1($input)->shouldReturn(32259706);
        $this->part2($input)->shouldReturn(113);
    }
}
