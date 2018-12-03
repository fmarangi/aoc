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

    function it_should_find_the_max_value_after_the_process()
    {
        $this->findMaxAfter($this->input)->shouldReturn(1);
    }

    function it_should_find_the_max_value_during_the_process()
    {
        $this->findMaxDuring($this->input)->shouldReturn(10);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day8.txt');
        $this->part1($input)->shouldReturn(5215);
        $this->part2($input)->shouldReturn(6419);
    }
}
