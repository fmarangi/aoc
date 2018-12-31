<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use Mzentrale\AdventOfCode\Year2016\Day19\Elf;

class Day19 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->solveWithBinary((int) trim($input));
    }

    public function part2(string $input)
    {
        return $this->solveWithLogicPt2((int) trim($input));
    }

    public function solveWithBinary(int $numElves): int
    {
        return 1 + 2 * ($numElves % pow(2, floor(log($numElves, 2))));
    }

    public function solveWithLogicPt2(int $numElves): int
    {
        $pow = (int) pow(3, floor(round(log($numElves, 3), 5)));
        if ($numElves === $pow) return $numElves;
        return $numElves / 2 < $pow ? $numElves - $pow : $pow + 2 * ($numElves % $pow);
    }
}
