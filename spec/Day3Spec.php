<?php

namespace spec\Mzentrale\AdventOfCode;

use PhpSpec\ObjectBehavior;

class Day3Spec extends ObjectBehavior
{
    function it_should_calculate_the_correct_distance()
    {
        $this->distance(1)->shouldReturn(0);
        $this->distance(10)->shouldReturn(3);
        $this->distance(11)->shouldReturn(2);
        $this->distance(12)->shouldReturn(3);
        $this->distance(23)->shouldReturn(2);
        $this->distance(24)->shouldReturn(3);
        $this->distance(1024)->shouldReturn(31);

    }
}
