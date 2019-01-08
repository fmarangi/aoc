<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day16Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_spins_programs()
    {
        $this->move('abcde', 's3')->shouldReturn('cdeab');
        $this->move('abcde', 's1')->shouldReturn('eabcd');
    }

    function it_exchanges_programs()
    {
        $this->move('eabcd', 'x3/4')->shouldReturn('eabdc');
    }

    function it_swaps_partner_programs()
    {
        $this->move('eabdc', 'pe/b')->shouldReturn('baedc');
    }

    function it_dances()
    {
        $this->dance('abcde', 's1,x3/4,pe/b')->shouldReturn('baedc');
    }

    function it_dances_twice()
    {
        $this->dance('abcde', 's1,x3/4,pe/b', 2)->shouldReturn('ceadb');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day16.txt');
        $this->part1($input)->shouldReturn('kpfonjglcibaedhm');
        $this->part2($input)->shouldReturn('odiabmplhfgjcekn');
    }
}
