<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day5Spec extends ObjectBehavior
{
    private $commands = "0
3
0
1
-3";

    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_split_commands()
    {
        $this->splitCommands($this->commands)->shouldReturn([0, 3, 0, 1, -3]);
    }

    function it_should_calculate_needed_steps()
    {
        $this->exit([0, 3, 0, 1, -3])->shouldReturn(5);
    }
}
