<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use Mzentrale\AdventOfCode\Year2016\Day2;
use PhpSpec\ObjectBehavior;
use spec\Mzentrale\AdventOfCode\Year2017\Year2017\Day7Spec;

class Day2Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculate_the_code()
    {
        $input = 'ULL
RRDDD
LURDL
UUUUD';
        $this->getCode('LLLDDD')->shouldReturn('7');
        $this->getCode('ULL')->shouldReturn('1');
        $this->getCode('UUU')->shouldReturn('2');
        $this->getCode('DDD')->shouldReturn('8');
        $this->getCode('LLLUUU')->shouldReturn('1');
        $this->getCode('RRRDDD')->shouldReturn('9');
        $this->getCode('RRRUUU')->shouldReturn('3');
        $this->getCode($input)->shouldReturn('1985');
        $this->getCode($input, Day2::DESIGN_2)->shouldReturn('5DB3');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day2.txt');
        $this->part1($input)->shouldReturn('33444');
        $this->part2($input)->shouldReturn('446A6');
    }
}
