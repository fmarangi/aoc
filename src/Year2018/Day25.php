<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day25 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->countConstellations($input);
    }

    public function part2(string $input)
    {
    }

    public function countConstellations(string $input): int
    {
        $points = $this->parseInput($input);

        $distances = [];
        for ($j = 0, $max = count($points); $j < $max; $j++) {
            $distances[$j] = $distances[$j] ?? [];
            for ($k = $j + 1; $k < $max; $k++) {
                if ($this->getDistance($points[$j], $points[$k]) <= 3) {
                    $distances[$j][] = $k;
                    $distances[$k][] = $j;
                }
            }
        }

        $constellations = [];
        foreach (array_keys($distances) as $point) {
            for ($i = 0, $max = count($constellations); $i < $max; $i++) {
                if (in_array($point, $constellations[$i])) {
                    continue 2;
                }
            }
            $constellations[count($constellations)] = $this->getConstellation($distances, $point);
        }

        return count($constellations);
    }

    private function getConstellation(array $distances, int $point): array
    {
        $constellation = [];
        $stack = [[$point], $distances[$point] ?? []];
        while ($stack) {
            $current = array_pop($stack);
            foreach ($current as $p) {
                if (!in_array($p, $constellation)) {
                    $constellation[] = $p;
                }
                if (array_diff($distances[$p] ?? [], $constellation)) {
                    $stack[] = array_diff($distances[$p] ?? [], $constellation);
                }
            }
        }
        return $constellation;
    }

    private function getDistance(array $a, array $b): int
    {
        return array_sum(array_map(function (int $a, int $b): int {
            return abs($a - $b);
        }, $a, $b));
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return array_map('intval', explode(',', $line));
        }, explode(PHP_EOL, trim($input)));
    }
}
