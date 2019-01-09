<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day24Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_quantum_entanglement()
    {
        $this->getQuantumEntanglement([8, 5, 4, 3])->shouldReturn(480);
        $this->getQuantumEntanglement([7, 5, 4, 3, 1])->shouldReturn(420);
    }

    function it_gets_the_best_arrangement()
    {
        $packages = array_merge(range(1, 5), range(7, 11));
        $this->getBestArrangement($packages)->shouldReturn(99);
    }

    function it_gets_the_best_arrangement_considering_the_trunk()
    {
        $packages = array_merge(range(1, 5), range(7, 11));
        $this->getBestArrangementWithTrunk($packages)->shouldReturn(44);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day24.txt');
        $this->part1($input)->shouldReturn(11846773891);
        $this->part2($input)->shouldReturn(80393059);
    }
}
