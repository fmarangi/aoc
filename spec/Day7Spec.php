<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day7Spec extends ObjectBehavior
{
    function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_solve_the_problem()
    {
        $this->solve("pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)
")->shouldReturn('tknk');
    }
}
