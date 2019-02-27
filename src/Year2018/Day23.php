<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day23 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getInRange($input);
    }

    public function part2(string $input)
    {
        return $this->getMostInRange($input);
    }

    public function getInRange(string $input): int
    {
        $nanobots = $this->parseInput($input);
        $ranges   = array_column($nanobots, 3);
        $max      = array_search(max($ranges), $ranges);
        $inRange  = array_filter($nanobots, $this->inRange($nanobots[$max]));
        return count($inRange);
    }

    public function getMostInRange(string $input): int
    {
        $nanobots = $this->parseInput($input);
        $inRange  = $this->ranges($nanobots);
        $largest  = $this->getLargestClique($inRange);
        return max(array_map(function (int $b) use ($nanobots): int {
            return $this->minDistance($nanobots[$b]);
        }, $largest));
    }

    private function getLargestClique(array $ranges): array
    {
        $count = array_map('count', $ranges);
        $freq  = max(array_count_values($count));
        $qty   = array_search($freq, $count);
        return $ranges[array_search($qty, $count)];
    }

    private function ranges(array $nanobots): array
    {
        $num    = count($nanobots);
        $ranges = array_map(function (int $nanobot): array {
            return [$nanobot];
        }, array_keys($nanobots));

        for ($j = 0; $j < $num - 1; $j++) {
            for ($k = $j + 1; $k < $num; $k++) {
                if ($this->bothInRange($nanobots[$j], $nanobots[$k])) {
                    array_push($ranges[$j], $k);
                    array_push($ranges[$k], $j);
                }
            }
        }
        return $ranges;
    }

    private function inRange(array $nanobot): callable
    {
        return function (array $other) use ($nanobot): bool {
            return $this->distance($other, $nanobot) <= $nanobot[3];
        };
    }

    private function bothInRange(array $a, array $b): bool
    {
        return $this->distance($a, $b) <= $a[3] + $b[3];
    }

    private function distance(array $a, array $b): int
    {
        return abs($a[0] - $b[0]) + abs($a[1] - $b[1]) + abs($a[2] - $b[2]);
    }

    private function minDistance(array $nanobot, array $to = [0, 0, 0]): int
    {
        return $this->distance($nanobot, $to) - $nanobot[3];
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            return sscanf($line, 'pos=<%d,%d,%d>, r=%d');
        }, explode(PHP_EOL, trim($input)));
    }
}
