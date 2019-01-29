<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day24 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->findShortestPath($input);
    }

    public function part2(string $input)
    {
        return $this->findShortestPath($input, '0');
    }

    public function findShortestPath(string $input, string $last = ''): int
    {
        $points = $this->parseInput($input);
        $length = $this->getPathLength($this->getDistances($points, $input), $last);
        return min(array_map($length, $this->getPaths(array_keys($points))));
    }

    private function getPathLength(array $distances, string $last): callable
    {
        return function (string $path) use ($distances, $last): int {
            for ($path .= $last, $i = $len = 0, $max = strlen($path) - 1; $i < $max; $i++) {
                $len += $distances[substr($path, $i, 2)];
            }
            return $len;
        };
    }

    private function getPaths(array $points, string $startWith = '0'): array
    {
        $points = array_values(array_diff($points, [$startWith]));
        return array_reduce($points, function(array $paths, string $point): array {
            $new = [];
            foreach ($paths as $path) {
                for ($i = 1, $max = strlen($path); $i <= $max; $i++) {
                    $new[] = substr($path, 0, $i) . $point . substr($path, $i);
                }
            }
            return $new;
        }, [$startWith]);
    }

    private function getDistances(array $points, string $grid): array
    {
        $next = $this->next($grid);
        $keys = array_keys($points);
        for ($j = 0, $distances = [], $max = count($keys); $j < $max - 1; $j++) {
            for ($k = $j + 1; $k < $max; $k++) {
                $distance = $this->distance($points[$keys[$j]], $points[$keys[$k]], $next);
                $distances[$keys[$j] . $keys[$k]] = $distance;
                $distances[$keys[$k] . $keys[$j]] = $distance;
            }
        }
        return $distances;
    }

    private function distance(int $from, int $to, callable $next): int
    {
        $seen  = [$from];
        $queue = [[0, $from]];
        while ($queue) {
            [$len, $curr] = array_shift($queue);
            foreach ($next($curr) as $p) {
                if ($p === $to) {
                    return $len + 1;
                } elseif (!in_array($p, $seen)) {
                    $seen[] = $p;
                    $queue[] = [$len + 1, $p];
                }
            }
        }
        return 999999;
    }

    private function next(string $grid): callable
    {
        $width = strpos($grid, PHP_EOL) + 1;
        return function (int $point) use ($grid, $width): array {
            $next = [];
            foreach ([$point - $width, $point - 1, $point + 1, $point + $width] as $p) {
                if ($grid{$p} !== '#') $next[] = $p;
            }
            return $next;
        };
    }

    private function parseInput(string $input): array
    {
        [$i, $points] = [0, []];
        while (($pos = strpos($input, (string) $i)) !== false) {
            $points[(string) $i++] = $pos;
        }
        return $points;
    }
}
