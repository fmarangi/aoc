<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    public function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_check_passphrase_uniqueness()
    {
        $this->hasNoDuplicates('aa bb cc dd ee')->shouldReturn(true);
        $this->hasNoDuplicates('aa bb cc dd aa')->shouldReturn(false);
        $this->hasNoDuplicates('aa bb cc dd aaa')->shouldReturn(true);
    }

    public function it_should_not_contains_anagrams()
    {
        $this->hasNoAnagrams('abcde fghij')->shouldReturn(true);
        $this->hasNoAnagrams('abcde xyz ecdab')->shouldReturn(false);
        $this->hasNoAnagrams('a ab abc abd abf abj')->shouldReturn(true);
        $this->hasNoAnagrams('iiii oiii ooii oooi oooo')->shouldReturn(true);
        $this->hasNoAnagrams('oiii ioii iioi iiio')->shouldReturn(false);
    }

    public function it_should_count_unique()
    {
        $this->countUnique("aa bb cc dd ee
aa bb cc dd aa
aa bb cc dd aaa")->shouldReturn(2);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/day4.txt');
        $this->part1($input)->shouldReturn(455);
        $this->part2($input)->shouldReturn(186);
    }
}
