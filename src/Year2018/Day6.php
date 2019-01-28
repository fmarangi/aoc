<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day6 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->findLargestArea($input);
    }

    public function part2(string $input)
    {
        return $this->findTotalDistanceLessThan($input, 10000);
    }

    public function findLargestArea(string $input): int
    {
        $coordinates = $this->parseInput($input);
        $distances   = $this->distances($coordinates);

        [$topLeft, $bottomRight] = $this->getCorners($coordinates);

        $infinite = $area = [];
        for ($j = $topLeft[0]; $j <= $bottomRight[0]; $j++) {
            for ($k = $topLeft[1]; $k <= $bottomRight[1]; $k++) {
                $distance = $distances([$j, $k]);

                $min = min($distance);
                if (array_count_values($distance)[$min] > 1) continue;

                $p = array_search($min, $distance);
                switch (true) {
                    case $j === $topLeft[0]:
                    case $j === $bottomRight[0]:
                    case $k === $topLeft[1]:
                    case $k === $bottomRight[1]:
                        $infinite[$p] = true;
                    default:
                        $area[$p] = ($area[$p] ?? 0) + 1;
                        break;
                }
            }
        }

        return max(array_diff_key($area, $infinite));
    }

    public function findTotalDistanceLessThan(string $input, int $maxDistance): int
    {
        $coordinates = $this->parseInput($input);
        $distances   = $this->distances($coordinates);

        [$topLeft, $bottomRight] = $this->getCorners($coordinates);

        $within = 0;
        for ($j = $topLeft[0]; $j <= $bottomRight[0]; $j++) {
            for ($k = $topLeft[1]; $k <= $bottomRight[1]; $k++) {
                $total = array_sum($distances([$j, $k]));
                if ($total < $maxDistance) $within++;
            }
        }

        return $within;
    }

    private function distances(array $coordinates): callable
    {
        return function (array $from) use ($coordinates): array {
            return array_map(function ($coordinate) use ($from): int {
                return abs($from[0] - $coordinate[0]) + abs($from[1] - $coordinate[1]);
            }, $coordinates);
        };
    }

    private function getCorners(array $coordinates): array
    {
        return [
            [min(array_column($coordinates, 0)), min(array_column($coordinates, 1))],
            [max(array_column($coordinates, 0)), max(array_column($coordinates, 1))],
        ];
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return array_map('intval', explode(', ', $line));
        }, explode(PHP_EOL, trim($input)));
    }
}
