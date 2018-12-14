<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day16Spec extends ObjectBehavior
{
    private $data = [
        'children'    => 3,
        'cats'        => 7,
        'samoyeds'    => 2,
        'pomeranians' => 3,
        'akitas'      => 0,
        'vizslas'     => 0,
        'goldfish'    => 5,
        'trees'       => 3,
        'cars'        => 2,
        'perfumes'    => 1,
    ];

    function let()
    {
        $this->beConstructedWith($this->data);
    }

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day16.txt');
        $this->part1($input)->shouldReturn(40);
        $this->part2($input)->shouldReturn(241);
    }
}
