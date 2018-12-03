<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day19Spec extends ObjectBehavior
{
    private $input = '     |          
     |  +--+    
     A  |  C    
 F---|----E|--+ 
     |  |  |  D 
     +B-+  +--+ 

';

    public function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_solve_the_sample_puzzle()
    {
        $this->follow($this->input)->shouldReturn('ABCDEF');
        $this->countSteps($this->input)->shouldReturn(38);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day19.txt');
        $this->part1($input)->shouldReturn('LIWQYKMRP');
        $this->part2($input)->shouldReturn(16764);
    }
}
