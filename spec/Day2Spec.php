<?php

namespace spec\Mzentrale\AdventOfCode;

use PhpSpec\ObjectBehavior;

class Day2Spec extends ObjectBehavior
{
    function it_should_calculate_the_correct_checksum()
    {
        $this->checksum('5 1 9 5
7 5 3
2 4 6 8')->shouldReturn(18);
    }
}
