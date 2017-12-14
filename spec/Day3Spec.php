<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day3Spec extends ObjectBehavior
{
    function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_calculate_the_correct_distance()
    {
        $this->distance(1)->shouldReturn(0);
        $this->distance(10)->shouldReturn(3);
        $this->distance(11)->shouldReturn(2);
        $this->distance(12)->shouldReturn(3);
        $this->distance(23)->shouldReturn(2);
        $this->distance(24)->shouldReturn(3);
        $this->distance(1024)->shouldReturn(31);
    }

    function it_should_calculate_the_grid()
    {
        $this->getGrid(9)->shouldReturn([
            '0:0'   => 1,
            '1:0'   => 2,
            '1:1'   => 3,
            '0:1'   => 4,
            '-1:1'  => 5,
            '-1:0'  => 6,
            '-1:-1' => 7,
            '0:-1'  => 8,
            '1:-1'  => 9,
        ]);
    }

    function it_should_calculate_square_values()
    {
        $this->getValue(1)->shouldReturn(1);
        $this->getValue(2)->shouldReturn(1);
        $this->getValue(3)->shouldReturn(2);
        $this->getValue(4)->shouldReturn(4);
        $this->getValue(5)->shouldReturn(5);
        $this->getValue(6)->shouldReturn(10);
        $this->getValue(7)->shouldReturn(11);
        $this->getValue(8)->shouldReturn(23);
        $this->getValue(9)->shouldReturn(25);
        $this->getValue(23)->shouldReturn(806);
    }

    function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/day3.txt');
        $this->part1($input)->shouldReturn(438);
        $this->part2($input)->shouldReturn(266330);
    }
}
