<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_checks_the_passphrase_uniqueness()
    {
        $this->hasNoDuplicates('aa bb cc dd ee')->shouldReturn(true);
        $this->hasNoDuplicates('aa bb cc dd aa')->shouldReturn(false);
        $this->hasNoDuplicates('aa bb cc dd aaa')->shouldReturn(true);
    }

    function it_contains_no_anagrams()
    {
        $this->hasNoAnagrams('abcde fghij')->shouldReturn(true);
        $this->hasNoAnagrams('abcde xyz ecdab')->shouldReturn(false);
        $this->hasNoAnagrams('a ab abc abd abf abj')->shouldReturn(true);
        $this->hasNoAnagrams('iiii oiii ooii oooi oooo')->shouldReturn(true);
        $this->hasNoAnagrams('oiii ioii iioi iiio')->shouldReturn(false);
    }

    function it_counts_the_unique()
    {
        $this->countUnique("aa bb cc dd ee
aa bb cc dd aa
aa bb cc dd aaa")->shouldReturn(2);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day4.txt');
        $this->part1($input)->shouldReturn(455);
        $this->part2($input)->shouldReturn(186);
    }
}
