<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day16Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_transforms_the_input()
    {
        $this->transform('1')->shouldReturn('100');
        $this->transform('0')->shouldReturn('001');
        $this->transform('11111')->shouldReturn('11111000000');
        $this->transform('111100001010')->shouldReturn('1111000010100101011110000');
    }

    function it_calculates_the_checksum()
    {
        $this->checksum('110010110100', 12)->shouldReturn('100');
        $this->checksum('10000', 20)->shouldReturn('01100');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day16.txt');
        $this->part1($input)->shouldReturn('10011010010010010');
        $this->part2($input)->shouldReturn('10101011110100011');
    }
}
