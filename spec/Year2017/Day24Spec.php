<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day24Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_bridge_strength()
    {
        $this->getStrength(['0/1', '10/1', '9/10'])->shouldReturn(31);
    }

    function it_get_the_strongest_bridge()
    {
        $input = '0/2
2/2
2/3
3/4
3/5
0/1
10/1
9/10';
        $this->getStrongestBridge($input)->shouldReturn(['0/1', '10/1', '9/10']);
    }

    function it_get_the_longest_bridge()
    {
        $input = '0/2
2/2
2/3
3/4
3/5
0/1
10/1
9/10';
        $this->getLongetBrige($input)->shouldReturn(['0/2', '2/2', '2/3', '3/5']);
    }

    private function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day24.txt');
        $this->part1($input)->shouldReturn(1868);
        $this->part2($input)->shouldReturn(1841);
    }
}
