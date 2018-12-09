<?php

namespace spec\Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day5Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_checks_nice_strings()
    {
        $this->isNice('ugknbfddgicrmopn')->shouldReturn(true);
        $this->isNice('aaa')->shouldReturn(true);
        $this->isNice('jchzalrnumimnmhp')->shouldReturn(false);
        $this->isNice('haegwjzuvuyypxyu')->shouldReturn(false);
        $this->isNice('dvszwmarrgswjxmb')->shouldReturn(false);
    }

    function it_checks_nicer_strings()
    {
        $this->isNicer('qjhvhtzxzqqjkmpb')->shouldReturn(true);
        $this->isNicer('xxyxx')->shouldReturn(true);
        $this->isNicer('uurcxstgmygtbstg')->shouldReturn(false);
        $this->isNicer('ieodomkazucvgmuy')->shouldReturn(false);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2015/day5.txt');
        $this->part1($input)->shouldReturn(255);
        $this->part2($input)->shouldReturn(55);
    }
}
