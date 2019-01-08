<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day21Spec extends ObjectBehavior
{
    private $rules = "../.# => ##./#../...\n.#./..#/### => #..#/..../..../#..#";

    function let()
    {
        $this->beConstructedWith(".#.\n..#\n###");
    }

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_calculates_the_numeric_value()
    {
        $this->getNumericValue(".#.\n..#\n###", "\n")->shouldReturn(143);
    }

    function it_rotates_an_image()
    {
        $this->rotate(".#.\n..#\n###")->shouldReturn("#..\n#.#\n##.");
    }

    function it_flips_an_image()
    {
        $this->flip(".#.\n..#\n###")->shouldReturn(".#.\n#..\n###");
    }

    function it_gets_the_numeric_values_of_a_pattern()
    {
        $this->getAllValues("..\n.#")->shouldReturn([1, 2, 8, 4]);
        $this->getAllValues("..\n..")->shouldReturn([0]);
        $this->getAllValues("##\n##")->shouldReturn([15]);
        $this->getAllValues(".#.\n..#\n###")->shouldReturn([143, 167, 302, 107, 482, 458, 233, 428]);
    }

    function it_counts_the_pixels()
    {
        $this->getPixelCount("..\n.#")->shouldReturn(1);
        $this->getPixelCount(".#.\n..#\n###")->shouldReturn(5);
    }

    function it_parses_the_rules()
    {
        $this->parseRules($this->rules)->shouldReturn([
            2 => [
                1 => "##.\n#..\n...",
                2 => "##.\n#..\n...",
                8 => "##.\n#..\n...",
                4 => "##.\n#..\n...",
            ],
            3 => [
                143 => "#..#\n....\n....\n#..#",
                167 => "#..#\n....\n....\n#..#",
                302 => "#..#\n....\n....\n#..#",
                107 => "#..#\n....\n....\n#..#",
                482 => "#..#\n....\n....\n#..#",
                458 => "#..#\n....\n....\n#..#",
                233 => "#..#\n....\n....\n#..#",
                428 => "#..#\n....\n....\n#..#",
            ],
        ]);
    }

    function it_splits_the_image()
    {
        $this->split("#..#\n....\n....\n#..#")->shouldReturn([
            "#.\n..",
            ".#\n..",
            "..\n#.",
            "..\n.#",
        ]);
        $this->split(".#.\n..#\n###")->shouldReturn([".#.\n..#\n###"]);
    }


    function it_joins_the_image()
    {
        $parts = [
            "#.\n..",
            ".#\n..",
            "..\n#.",
            "..\n.#",
        ];
        $this->join($parts)->shouldReturn("#..#\n....\n....\n#..#");
    }

    function it_enhances_the_image()
    {
        $this->enhance($this->rules, 1)->shouldReturn("#..#\n....\n....\n#..#");
        $this->enhance($this->rules, 2)->shouldReturn("##.##.\n#..#..\n......\n##.##.\n#..#..\n......");
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day21.txt');
        $this->part1($input)->shouldReturn(208);
        $this->part2($input)->shouldReturn(2480380);
    }
}
