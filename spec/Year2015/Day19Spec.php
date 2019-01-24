<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day19Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_distinct_molecules()
    {
        $rules = [['H', 'HO'], ['H', 'OH'], ['O', 'HH']];
        $this->getDistinctMolecules($rules, 'HOH')->shouldHaveCount(4);
        $this->getDistinctMolecules($rules, 'HOHOHO')->shouldHaveCount(7);
    }

    function it_generates_the_molecule()
    {
        $rules = [['H', 'HO'], ['H', 'OH'], ['O', 'HH'], ['e', 'H'], ['e', 'O']];
        $this->generate($rules, 'HOH')->shouldReturn(3);
        $this->generate($rules, 'HOHOHO')->shouldReturn(6);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day19.txt');
        $this->part1($input)->shouldReturn(576);
        $this->part2($input)->shouldReturn(207);
    }
}
