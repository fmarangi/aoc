<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day21Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_applies_the_rules()
    {
        $this->apply('abcde', 'reverse positions 1 through 3')->shouldReturn('adcbe');
        $this->apply('abcde', 'swap position 4 with position 0')->shouldReturn('ebcda');
        $this->apply('ebcda', 'swap letter d with letter b')->shouldReturn('edcba');
        $this->apply('abcde', 'rotate left 1 step')->shouldReturn('bcdea');
        $this->apply('abcde', 'rotate right 1 step')->shouldReturn('eabcd');
        $this->apply('abdec', 'rotate based on position of letter b')->shouldReturn('ecabd');
        $this->apply('ecabd', 'rotate based on position of letter d')->shouldReturn('decab');
        $this->apply('bcdea', 'move position 1 to position 4')->shouldReturn('bdeac');
        $this->apply('bdeac', 'move position 3 to position 0')->shouldReturn('abdec');
    }

    function it_scrambles_the_password()
    {
        $this->scramble('abcde', [
            'swap position 4 with position 0',
            'swap letter d with letter b',
            'reverse positions 0 through 4',
            'rotate left 1 step',
            'move position 1 to position 4',
            'move position 3 to position 0',
            'rotate based on position of letter b',
            'rotate based on position of letter d',
        ])->shouldReturn('decab');
    }

    function it_unapplies_the_rules()
    {
        $this->unapply('abcde', 'reverse positions 1 through 3')->shouldReturn('adcbe');
        $this->unapply('ebcda', 'swap position 4 with position 0')->shouldReturn('abcde');
        $this->unapply('edcba', 'swap letter d with letter b')->shouldReturn('ebcda');
        $this->unapply('bcdea', 'rotate left 1 step')->shouldReturn('abcde');
        $this->unapply('bdeac', 'move position 1 to position 4')->shouldReturn('bcdea');
        $this->unapply('ecabd', 'rotate based on position of letter b')->shouldReturn('abdec');
        $this->unapply('decab', 'rotate based on position of letter d')->shouldReturn('ecabd');
    }

    function it_unscrambles_the_password()
    {
        $this->unscramble('decab', [
            'swap position 4 with position 0',
            'swap letter d with letter b',
            'reverse positions 0 through 4',
            'rotate left 1 step',
            'move position 1 to position 4',
            'move position 3 to position 0',
            'rotate based on position of letter b',
            'rotate based on position of letter d',
        ])->shouldReturn('abcde');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day21.txt');
        $this->part1($input)->shouldReturn('gbhafcde');
        $this->part2($input)->shouldReturn('bcfaegdh');
    }
}
