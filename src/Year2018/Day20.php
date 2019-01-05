<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day20 implements Puzzle
{
    /** @var array */
    private $offsets = [
        'N' => [0, -1],
        'E' => [1, 0],
        'S' => [0, 1],
        'W' => [-1, 0],
    ];

    public function part1(string $input)
    {
        return $this->findShortestPath(trim($input));
    }

    public function part2(string $input)
    {
        $rooms = $this->explore(trim($input));
        return count(array_filter($rooms, function (int $dist) {
            return $dist >= 1000;
        }));
    }

    public function findShortestPath(string $map): int
    {
        return max($this->explore($map));
    }

    private function explore(string $map): array
    {
        $current = [0, 0, 0];
        $branch = $rooms = [];
        for ($i = 1, $max = strlen($map) - 1; $i < $max; $i++) {
            $char = $map{$i};
            switch ($char) {
                case '(':
                    $branch[] = $current;
                    continue 2;
                case '|':
                    $current = $branch[count($branch) - 1];
                    continue 2;
                case ')':
                    $current = array_pop($branch);
                    continue 2;
                default:
                    list($dx, $dy) = $this->offsets[$char];
                    $current = [$current[0] + $dx, $current[1] + $dy, $current[2] + 1];
                    break;
            }

            list($x, $y, $dist) = $current;
            $room = "{$x},{$y}"; 
            $rooms[$room] = min(($rooms[$room] ?? 9999), $dist);
        }
        return $rooms;
    }
}
