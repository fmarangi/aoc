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

    function it_should_calculate_needed_steps_for_first_part()
    {
        $this->exit1([0, 3, 0, 1, -3])->shouldReturn(5);
    }

    function it_should_calculate_needed_steps_for_second_part()
    {
        $this->exit2([0, 3, 0, 1, -3])->shouldReturn(10);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/day5.txt');
        $this->part1($input)->shouldReturn(388611);
        // $this->part2($input)->shouldReturn(27763113);
    }
}
