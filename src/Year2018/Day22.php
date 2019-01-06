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
        for ($y = $risk = 0, $maxY = count($cave); $y < $maxY; $y++) {
            for ($x = 0, $maxX = count($cave[$y]); $x < $maxX; $x++) {
                $risk += $cave[$y][$x][1];
            }
        }
        return $risk;
    }

    private function getCave(int $x, int $y, int $depth): array
    {
        $cave = [];
        for ($j = 0; $j <= $x; $j++) {
            for ($k = 0; $k <= $y; $k++) {
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
                        $index = $cave[$k - 1][$j][0] * $cave[$k][$j - 1][0];
                        break;
                }

                $cave[$k][$j][0] = ($index + $depth) % 20183;
                $cave[$k][$j][1] = $cave[$k][$j][0] % 3;
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
