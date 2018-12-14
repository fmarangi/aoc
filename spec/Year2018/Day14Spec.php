<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day14Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_recipe_score()
    {
        $this->getScoreAfter(9)->shouldReturn('5158916779');
        $this->getScoreAfter(5)->shouldReturn('0124515891');
        $this->getScoreAfter(18)->shouldReturn('9251071085');
        $this->getScoreAfter(2018)->shouldReturn('5941429882');
    }

    function it_checks_the_sequence_of_the_recipes()
    {
        $this->getAppearsAfter('51589')->shouldReturn(9);
        $this->getAppearsAfter('01245')->shouldReturn(5);
        $this->getAppearsAfter('92510')->shouldReturn(18);
        $this->getAppearsAfter('59414')->shouldReturn(2018);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day14.txt');
        $this->part1($input)->shouldReturn('7861362411');
        $this->part2($input)->shouldReturn(20203532);
    }
}
