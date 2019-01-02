<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day18Spec extends ObjectBehavior
{
    /** @var string */
    private $sample = '.#.#.#
...##.
#....#
..#...
#.#..#
####..';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_next_state()
    {
        $this->nextState($this->sample)->shouldReturn('..##..
..##.#
...##.
......
#.....
#.##..');
    }

    function it_stucks_the_corner_lights()
    {
        $this->stuck($this->sample)->shouldReturn('##.#.#
...##.
#....#
..#...
#.#..#
####.#');
    }

    function it_counts_the_lights()
    {
        $this->countLights($this->sample, 4)->shouldReturn(4);
        $this->countLights($this->sample, 5, true)->shouldReturn(17);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day18.txt');
        $this->part1($input)->shouldReturn(1061);
        $this->part2($input)->shouldReturn(1006);
    }
}
