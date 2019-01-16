<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day25 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getCode(...$this->parseInput($input));
    }

    public function part2(string $input)
    {
    }

    public function getCode(int $x, int $y): int
    {
        $j = $k = 1;
        $code = 20151125;
        while ($j !== $x || $k !== $y) {
            $code = ($code * 252533) % 33554393;
            $j++;
            $k--;
            if ($k === 0) {
                $k = $j;
                $j = 1;
            }
        }
        return $code;
    }

    private function parseInput(string $input): array
    {
        $fmt = 'To continue, please consult the code grid in the manual.  Enter the code at row %d, column %d.';
        return array_reverse(sscanf(trim($input), $fmt));
    }
}
