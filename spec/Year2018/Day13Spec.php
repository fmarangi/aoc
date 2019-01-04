<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day13Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_first_crash()
    {
        $this->getFirstCrash('/->-\        
|   |  /----\
| /-+--+-\  |
| | |  | v  |
\-+-/  \-+--/
  \------/   
')->shouldReturn([7, 3]);
    }

    function it_calculates_the_last_cart()
    {
        $this->getLastCart('/>-<\  
|   |  
| /<+-\
| | | v
\>+</ |
  |   ^
  \<->/
')->shouldReturn([6, 4]);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day13.txt');
        $this->part1($input)->shouldReturn('139,65');
        $this->part2($input)->shouldReturn('40,77');
    }
}
