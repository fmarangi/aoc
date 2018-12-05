<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day6Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_recovers_the_message()
    {
        $input = 'eedadn
drvtee
eandsr
raavrd
atevrs
tsrnev
sdttsa
rasrtv
nssdts
ntnada
svetve
tesnvt
vntsnd
vrdear
dvrsen
enarar';
        $this->recoverMessage($input)->shouldReturn('easter');
        $this->recoverMessage($input, false)->shouldReturn('advent');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day6.txt');
        $this->part1($input)->shouldReturn('ygjzvzib');
        $this->part2($input)->shouldReturn('pdesmnoz');
    }
}
