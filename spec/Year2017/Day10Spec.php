<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day10Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_apply_hash()
    {
        $this->apply([0, 1, 2, 3, 4], 0, 3)->shouldReturn([2, 1, 0, 3, 4]);
        $this->apply([2, 1, 0, 3, 4], 3, 4)->shouldReturn([4, 3, 0, 1, 2]);
        $this->apply([4, 3, 0, 1, 2], 1, 1)->shouldReturn([4, 3, 0, 1, 2]);
        $this->apply([4, 3, 0, 1, 2], 1, 5)->shouldReturn([3, 4, 2, 1, 0]);
    }

    function it_should_apply_lengths()
    {
        $this->factor([3, 4, 1, 5], 5)->shouldReturn(12);
    }

    function it_should_hash_strings()
    {
        $this->hash('')->shouldReturn('a2582a3a0e66e6e86e3812dcb672a272');
        $this->hash('AoC 2017')->shouldReturn('33efeb34ea91902bb2f59c9920caa6cd');
        $this->hash('1,2,4')->shouldReturn('63960835bcdc130f0b66d7ff4f6a5a8e');
        $this->hash('1,2,3')->shouldReturn('3efbe78a8d82f29979031a4aa0b16a9d');
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day10.txt');
        $this->part1($input)->shouldReturn(8536);
        $this->part2($input)->shouldReturn('aff593797989d665349efe11bb4fd99b');
    }
}
