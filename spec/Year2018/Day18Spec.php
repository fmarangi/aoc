<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day18Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_should_get_the_total_resource_value()
    {
        $input = '.#.#...|#.
.....#|##|
.|..|...#.
..|#.....#
#.#|||#|#|
...#.||...
.|....|...
||...#|.#|
|.||||..|.
...#.|..|.';
        $this->getTotalResourceValue($input, 10)->shouldReturn(1147);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day18.txt');
        $this->part1($input)->shouldReturn(506385);
        $this->part2($input)->shouldReturn(215404);
    }
}
