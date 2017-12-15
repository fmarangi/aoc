<?php

namespace Mzentrale\AdventOfCode;

class Day11 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->distance(explode(',', trim($input)));
    }

    public function part2(string $input)
    {
        return $this->maxDistance(explode(',', trim($input)));
    }

    public function distance(array $path): int
    {
        $initial = [0, 0];
        return $this->calculateDistance($initial, array_reduce($path, [$this, 'move'], $initial));
    }

    public function maxDistance(array $path): int
    {
        $initial  = [0, 0];
        $current  = $initial;
        $distance = 0;
        foreach ($path as $next) {
            $current  = $this->move($current, $next);
            $distance = max($distance, $this->calculateDistance($initial, $current));
        }
        return $distance;
    }

    private function getMove(string $direction): array
    {
        switch ($direction) {
            case 'n':
                return [0, 1];
            case 'ne':
                return [1, 0.5];
            case 'se':
                return [1, -0.5];
            case 's':
                return [0, -1];
            case 'sw':
                return [-1, -0.5];
            case 'nw':
                return [-1, 0.5];
        }
    }

    private function move($current, $next): array
    {
        $move       = $this->getMove($next);
        $current[0] += $move[0];
        $current[1] += $move[1];
        return $current;
    }

    private function calculateDistance(array $initial, array $position): int
    {
        return (abs($initial[0] - $position[0]) + abs($initial[0] - $position[1] * 2)) / 2;
    }
}
