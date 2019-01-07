<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day22 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getRiskLevel(...$this->parseInput($input));
    }

    public function part2(string $input)
    {
    }

    public function getRiskLevel(int $x, int $y, int $depth): int
    {
        $cave = $this->getCave($x, $y, $depth);
        for ($j = $risk = 0; $j <= $y; $j++) {
            for ($k = 0; $k <= $x; $k++) {
                $risk += $cave[$j][$k];
            }
        }
        return $risk;
    }

    private function getCave(int $x, int $y, int $depth): array
    {
        $cave = $levels = [];
        for ($j = 0; $j <= $x + 10; $j++) {
            for ($k = 0; $k <= $y + 10; $k++) {
                $index = 0;
                switch (true) {
                    case ($j === 0 && $k === 0) || ($j === $x && $k === $y):
                        break;

                    case $j === 0:
                        $index = $k * 48271;
                        break;

                    case $k === 0:
                        $index = $j * 16807;
                        break;

                    default:
                        $index = $levels[$k - 1][$j] * $levels[$k][$j - 1];
                        break;
                }

                $levels[$k][$j] = ($index + $depth) % 20183;
                $cave[$k][$j]   = $levels[$k][$j] % 3;
            }
        }
        return $cave;
    }

    private function parseInput(string $input): array
    {
        $data = array_map(function (string $line): string {
            return explode(': ', $line)[1];
        }, explode(PHP_EOL, trim($input)));
        return array_merge(explode(',', $data[1]), [$data[0]]);
    }
}
