<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day9Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_decompresses_the_string()
    {
        $this->decompress('ADVENT')->shouldReturn(strlen('ADVENT'));
        $this->decompress('A(1x5)BC')->shouldReturn(strlen('ABBBBBC'));
        $this->decompress('(3x3)XYZ')->shouldReturn(strlen('XYZXYZXYZ'));
        $this->decompress('A(2x2)BCD(2x2)EFG')->shouldReturn(strlen('ABCBCDEFEFG'));
        $this->decompress('(6x1)(1x3)A')->shouldReturn(strlen('(1x3)A'));
        $this->decompress('X(8x2)(3x3)ABCY')->shouldReturn(strlen('X(3x3)ABC(3x3)ABCY'));

        $this->decompress('(3x3)XYZ', true)->shouldReturn(strlen('XYZXYZXYZ'));
        $this->decompress('X(8x2)(3x3)ABCY', true)->shouldReturn(strlen('XABCABCABCABCABCABCY'));
        $this->decompress('(27x12)(20x12)(13x14)(7x10)(1x12)A', true)->shouldReturn(241920);
        $this->decompress('(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN', true)->shouldReturn(445);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day9.txt');
        $this->part1($input)->shouldReturn(115118);
        // $this->part2($input)->shouldReturn(11107527530);
    }
}
