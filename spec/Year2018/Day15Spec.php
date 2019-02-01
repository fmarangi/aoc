<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day15Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_battle_outcome()
    {
        $this->getBattleOutCome('#######
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######')->shouldReturn(27730);

        $this->getBattleOutCome('#######
#G..#E#
#E#E.E#
#G.##.#
#...#E#
#...E.#
#######')->shouldReturn(36334);

        $this->getBattleOutCome('#######
#E..EG#
#.#G.E#
#E.##E#
#G..#.#
#..E#.#
#######')->shouldReturn(39514);

        $this->getBattleOutCome('#######
#E.G#.#
#.#G..#
#G.#.G#
#G..#.#
#...E.#
#######')->shouldReturn(27755);

        $this->getBattleOutCome('#######
#.E...#
#.#..G#
#.###.#
#E#G#G#
#...#G#
#######')->shouldReturn(28944);

        $this->getBattleOutCome('#########
#G......#
#.E.#...#
#..##..G#
#...##..#
#...#...#
#.G...G.#
#.....G.#
#########')->shouldReturn(18740);
    }

    function it_helps_the_elves_win()
    {
        $this->helpElvesWin('#######
#E..EG#
#.#G.E#
#E.##E#
#G..#.#
#..E#.#
#######')->shouldReturn(31284);

        $this->helpElvesWin('#######
#.G...#
#...EG#
#.#.#G#
#..G#E#
#.....#
#######')->shouldReturn(4988);

        $this->helpElvesWin('#######
#E.G#.#
#.#G..#
#G.#.G#
#G..#.#
#...E.#
#######')->shouldReturn(3478);

        $this->helpElvesWin('#######
#.E...#
#.#..G#
#.###.#
#E#G#G#
#...#G#
#######')->shouldReturn(6474);

        $this->helpElvesWin('#########
#G......#
#.E.#...#
#..##..G#
#...##..#
#...#...#
#.G...G.#
#.....G.#
#########')->shouldReturn(1140);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day15.txt');
        $this->part1($input)->shouldReturn(181522);
        $this->part2($input)->shouldReturn(68324);
    }
}
