<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day16Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_spin_programs()
    {
        $this->move('abcde', 's3')->shouldReturn('cdeab');
        $this->move('abcde', 's1')->shouldReturn('eabcd');
    }

    public function it_should_exchange_programs()
    {
        $this->move('eabcd', 'x3/4')->shouldReturn('eabdc');
    }

    public function it_should_swap_partner_programs()
    {
        $this->move('eabdc', 'pe/b')->shouldReturn('baedc');
    }

    public function it_should_dance()
    {
        $this->dance('abcde', 's1,x3/4,pe/b')->shouldReturn('baedc');
    }

    public function it_should_dance_twice()
    {
        $this->dance('abcde', 's1,x3/4,pe/b', 2)->shouldReturn('ceadb');
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(__DIR__) . '/input/year2017/day16.txt');
        $this->part1($input)->shouldReturn('kpfonjglcibaedhm');
        $this->part2($input)->shouldReturn('odiabmplhfgjcekn');
    }
}
