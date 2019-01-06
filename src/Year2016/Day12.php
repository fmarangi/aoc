<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day12 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getValueOfA($input);
    }

    public function part2(string $input)
    {
        return $this->getValueOfA($input, 1);
    }

    public function getValueOfA(string $input, int $c = 0): int
    {
        $registers      = array_combine(range('a', 'd'), array_fill(0, 4, 0));
        $registers['c'] = $c;
        $instructions   = $this->parseInput($input);
        for ($i = 0, $max = count($instructions); $i < $max; $i++) {
            switch ($instructions[$i][0]) {
                case 'inc':
                    $registers[$instructions[$i][1]] += 1;
                    break;
                case 'dec':
                    $registers[$instructions[$i][1]] -= 1;
                    break;
                case 'cpy':
                    $what = $instructions[$i][1];
                    $registers[$instructions[$i][2]] = ($registers[$what] ?? (int) $what);
                    break;
                case 'jnz':
                    $what = $instructions[$i][1];
                    if (($registers[$what] ?? $what) !== 0) $i += $instructions[$i][2] - 1;
                    break;
            }
        }
        return $registers['a'];
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return explode(' ', $line);
        }, explode(PHP_EOL, trim($input)));
    }
}
