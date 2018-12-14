<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day8Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_length_difference()
    {
        $this->getStringDataLength('""')->shouldReturn(0);
        $this->getStringDataLength('"abc"')->shouldReturn(3);
        $this->getStringDataLength('"aaa\"aaa"')->shouldReturn(7);
        $this->getStringDataLength('"\x27"')->shouldReturn(1);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day8.txt');
        $this->part1($input)->shouldReturn(1333);
        $this->part2($input)->shouldReturn(2046);
    }
}
