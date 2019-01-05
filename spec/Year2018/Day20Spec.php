<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day20Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_finds_the_shortest_path()
    {
        $this->findShortestPath('^WNE$')->shouldReturn(3);
        $this->findShortestPath('^ENNWSWW(NEWS|)SSSEEN(WNSE|)EE(SWEN|)NNN$')->shouldReturn(18);
        $this->findShortestPath('^ENWWW(NEEE|SSE(EE|N))$')->shouldReturn(10);
        $this->findShortestPath('^ESSWWN(E|NNENN(EESS(WNSE|)SSS|WWWSSSSE(SW|NNNE)))$')->shouldReturn(23);
        $this->findShortestPath('^WSSEESWWWNW(S|NENNEEEENN(ESSSSW(NWSW|SSEN)|WSWWN(E|WWS(E|SS))))$')->shouldReturn(31);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day20.txt');
        $this->part1($input)->shouldReturn(3314);
        $this->part2($input)->shouldReturn(8550);
    }
}
