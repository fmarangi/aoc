<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day2Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_box_value()
    {
        $this->hasTwoLetters('abcdef')->shouldReturn(false);
        $this->hasTwoLetters('bababc')->shouldReturn(true);
        $this->hasTreeLetters('bababc')->shouldReturn(true);
    }

    function it_calculates_the_checksum()
    {
        $boxes = "abcdef\nbababc\nabbcde\nabcccd\naabcdd\nabcdee\nababab";
        $this->getChecksum($boxes)->shouldReturn(12);
    }

    function it_calculates_the_differences()
    {
        $this->getDifferences('abcde', 'axcye')->shouldReturn(2);
        $this->getDifferences('fghij', 'fguij')->shouldReturn(1);

        $this->getCommon('fghij', 'fguij')->shouldReturn('fgij');

        $boxes = "abcde\nfghij\nklmno\npqrst\nfguij\naxcye\nwvxyz";
        $this->getSimilar($boxes)->shouldReturn('fgij');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day2.in');
        $this->part1($input)->shouldReturn(8118);
        $this->part2($input)->shouldReturn('jbbenqtlaxhivmwyscjukztdp');
    }
}
