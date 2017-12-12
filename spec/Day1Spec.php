<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day1Spec extends ObjectBehavior
{
    public function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_calculate_simple_cases()
    {
        $this->captcha('1234')->shouldReturn(0);
        $this->captcha('1122')->shouldReturn(3);
        $this->captcha('1111')->shouldReturn(4);
        $this->captcha('91212129')->shouldReturn(9);
    }
}
