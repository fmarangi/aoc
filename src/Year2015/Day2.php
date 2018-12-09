<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day2 implements Puzzle
{
    public function part1(string $input)
    {
        return array_sum(array_map([$this, 'getPaperSurface'], explode(PHP_EOL, trim($input))));
    }

    public function part2(string $input)
    {
        return array_sum(array_map([$this, 'getRibbonLength'], explode(PHP_EOL, trim($input))));
    }

    public function getPaperSurface(string $measurements): int
    {
        $sides = $this->getSides($measurements);
        return 2 * ($sides[0] * $sides[1] + $sides[1] * $sides[2] + $sides[0] * $sides[2]) + $sides[0] * $sides[1];
    }

    public function getRibbonLength(string $measurements): int
    {
        $sides = $this->getSides($measurements);
        return 2 * ($sides[0] + $sides[1]) + $sides[0] * $sides[1] * $sides[2];
    }

    private function getSides(string $measurements): array
    {
        $sides = array_map('intval', explode('x', trim($measurements)));
        sort($sides);
        return $sides;
    }
}
