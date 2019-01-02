<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day17Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_finds_the_shortest_path()
    {
    	$this->findShortestPath('ihgpwlah')->shouldReturn('DDRRRD');
    	$this->findShortestPath('kglvqrro')->shouldReturn('DDUDRLRRUDRD');
    	$this->findShortestPath('ulqzkmiv')->shouldReturn('DRURDRUDDLLDLUURRDULRLDUUDDDRR');
    }

    function it_finds_the_longest_path()
    {
    	$this->findLongestPath('ihgpwlah')->shouldReturn(370);
    	$this->findLongestPath('kglvqrro')->shouldReturn(492);
    	$this->findLongestPath('ulqzkmiv')->shouldReturn(830);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day17.txt');
        $this->part1($input)->shouldReturn('RDRDUDLRDR');
        $this->part2($input)->shouldReturn(386);
    }
}
