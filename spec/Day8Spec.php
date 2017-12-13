<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day8Spec extends ObjectBehavior
{
    private $input = <<<INPUT
b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
INPUT;

    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_parse_lines_correctly()
    {
        foreach (explode(PHP_EOL, trim($this->input)) as $line) {
            $this->parseLine($line)->shouldHaveCount(3);
        }
    }

    function it_should_solve_the_puzzle()
    {
        $this->solve($this->input)->shouldReturn(1);
    }
}
