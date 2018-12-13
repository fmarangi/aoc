<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day9Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_winning_score()
    {
        $this->getWinningScore(9, 25)->shouldReturn(32);
        $this->getWinningScore(10, 1618)->shouldReturn(8317);
        $this->getWinningScore(13, 7999)->shouldReturn(146373);
        $this->getWinningScore(17, 1104)->shouldReturn(2764);
        $this->getWinningScore(21, 6111)->shouldReturn(54718);
        $this->getWinningScore(30, 5807)->shouldReturn(37305);
    }

    function it_gets_the_winning_score_with_linked_list()
    {
        $this->getWinningScoreOptimized(9, 25)->shouldReturn(32);
        $this->getWinningScoreOptimized(10, 1618)->shouldReturn(8317);
        $this->getWinningScoreOptimized(13, 7999)->shouldReturn(146373);
        $this->getWinningScoreOptimized(17, 1104)->shouldReturn(2764);
        $this->getWinningScoreOptimized(21, 6111)->shouldReturn(54718);
        $this->getWinningScoreOptimized(30, 5807)->shouldReturn(37305);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day9.txt');
        $this->part1($input)->shouldReturn(429943);
        // $this->part2($input)->shouldReturn(3615691746);
    }
}
