<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Day15;
use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class Day15Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_create_the_generators()
    {
        $this->getGenerator(Day15::FACTOR_A, 65, 5)->shouldGenerate([
            1092455,
            1181022009,
            245556042,
            1744312007,
            1352636452,
        ]);
        $this->getGenerator(Day15::FACTOR_B, 8921, 5)->shouldGenerate([
            430625591,
            1233683848,
            1431495498,
            137874439,
            285222916,
        ]);
    }

    function it_should_create_the_generators_for_part2()
    {
        $this->getPart2Generator(Day15::FACTOR_A, 65, 5, 4)->shouldGenerate([
            1352636452,
            1992081072,
            530830436,
            1980017072,
            740335192,
        ]);
        $this->getPart2Generator(Day15::FACTOR_B, 8921, 5, 8)->shouldGenerate([
            1233683848,
            862516352,
            1159784568,
            1616057672,
            412269392,
        ]);
    }

    function it_should_compare_numbers()
    {
        $this->match(1092455, 430625591)->shouldBe(false);
        $this->match(245556042, 1431495498)->shouldBe(true);
    }

    function it_should_count_matches()
    {
        $this->countMatches(65, 8921, 5)->shouldReturn(1);
//        $this->countMatches(65, 8921, 40000000)->shouldReturn(588);
    }

    function it_should_count_matches_for_part2()
    {
        $this->countMatchesPart2(65, 8921, 1055)->shouldReturn(0);
        $this->countMatchesPart2(65, 8921, 1056)->shouldReturn(1);
    }

    function it_should_solve_the_puzzle()
    {
        return;
        $input = trim(file_get_contents(dirname(__DIR__) . '/input/year2017/day15.txt'));
        $this->part1($input)->shouldReturn(638);
        $this->part2($input)->shouldReturn(343);
    }

    public function getMatchers(): array
    {
        return [
            'generate' => function ($subject, $value) {
                if (!$subject instanceof \Traversable) {
                    throw new FailureException('Return value should be instance of \Traversable');
                }
                return iterator_to_array($subject) === $value;
            },
        ];
    }
}
