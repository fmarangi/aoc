<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day3 implements Puzzle
{
    public function part1(string $input)
    {
        return count(array_filter($this->parseInput($input), [$this, 'isTriangle']));
    }

    public function part2(string $input)
    {
        $rows      = $this->parseInput($input);
        $triangles = [];
        for ($i = 0; $i < 3; $i++) {
            $triangles = array_merge($triangles, array_chunk(array_column($rows, $i), 3));
        }
        return count(array_filter($triangles, [$this, 'isTriangle']));
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            return array_map('intval', str_split($line, 5));
        }, explode(PHP_EOL, trim($input)));
    }

    private function isTriangle(array $triangle): bool
    {
        $max = max($triangle);
        return array_sum($triangle) - $max > $max;
    }
}
