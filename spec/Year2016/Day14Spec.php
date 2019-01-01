<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day14Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_generates_the_hash()
    {
        $this->hash('abc0', 2016)->shouldStartWith('a107ff');
    }

    function it_generates_the_keys()
    {
        $this->generateKeys('abc', 64)->shouldReturn(22728);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day14.txt');
        $this->part1($input)->shouldReturn(23890);
        $this->part2($input)->shouldReturn(22696);
    }
}
