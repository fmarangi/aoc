<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day1 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getFloor($input);
    }

    public function part2(string $input)
    {
        return $this->enterBasement($input);
    }

    public function getFloor(string $input): int
    {
        return substr_count($input, '(') - substr_count($input, ')');
    }

    public function enterBasement(string $input): int
    {
        $input = trim($input);
        for ($i = 0, $max = strlen($input), $position = 0; $i < $max; $i++) {
            $position += $input{$i} === '(' ? +1 : -1;
            if ($position < 0) return $i + 1;
        }
        return -1;
    }
}
