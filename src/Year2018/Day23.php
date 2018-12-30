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
        // TODO: Implement part2() method.
    }

    public function getInRange(string $input): int
    {
        $nanobots = $this->parseInput($input);
        $ranges   = array_column($nanobots, 3);
        $max      = array_search(max($ranges), $ranges);
        $inRange  = array_filter($nanobots, $this->inRange($nanobots[$max]));
        return count($inRange);
    }

    private function inRange(array $nanobot): callable
    {
        return function (array $other) use ($nanobot): bool {
            return $this->distance($other, $nanobot) <= $nanobot[3];
        };
    }

    private function distance(array $a, array $b): int
    {
        return abs($a[0] - $b[0]) + abs($a[1] - $b[1]) + abs($a[2] - $b[2]);
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            return sscanf($line, 'pos=<%d,%d,%d>, r=%d');
        }, explode(PHP_EOL, trim($input)));
    }
}
