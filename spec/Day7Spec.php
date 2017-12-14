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

    function it_should_parse_lines()
    {
        $this->parse('tknk (41) -> ugml, padx, fwft')->shouldContain('tknk');
        $this->parse('pbga (66)')->shouldReturn(['pbga', [], 66]);
        $this->parse('pbga (66)')->shouldContain('pbga');
    }

    function it_should_find_the_bottom_tower()
    {
        $this->findBottom($this->input())->shouldReturn('tknk');
    }

    function it_should_find_the_wrong_weight()
    {
        $this->findWrong($this->input())->shouldReturn(60);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/day7.txt');
        $this->part1($input)->shouldReturn('bpvhwhh');
        $this->part2($input)->shouldReturn(256);
    }

    private function input(): string
    {
        return 'pbga (66)
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
';
    }
}
