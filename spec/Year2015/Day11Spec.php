<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day11Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_increments_the_password()
    {
        $this->increment('xx')->shouldReturn('xy');
        $this->increment('xy')->shouldReturn('xz');
        $this->increment('xz')->shouldReturn('ya');
        $this->increment('ya')->shouldReturn('yb');
        $this->increment('abcdabcd')->shouldReturn('abcdabce');
        $this->increment('zzzzzzzz')->shouldReturn('aaaaaaaa');
    }

    function it_validates_the_password()
    {
        $this->isValid('hijklmmn')->shouldReturn(false);
        $this->isValid('abbceffg')->shouldReturn(false);
        $this->isValid('abbcegjk')->shouldReturn(false);
        $this->isValid('abcdffaa')->shouldReturn(true);
        $this->isValid('ghjaabcc')->shouldReturn(true);
    }

    function it_calculates_the_next_password()
    {
        $this->getNext('abcdefgh')->shouldReturn('abcdffaa');
        $this->getNext('ghijklmn')->shouldReturn('ghjaabcc');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day11.txt');
        $this->part1($input)->shouldReturn('vzbxxyzz');
        $this->part2($input)->shouldReturn('vzcaabcc');
    }
}
