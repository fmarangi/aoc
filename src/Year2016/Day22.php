<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day22 implements Puzzle
{
    private const USED  = 2;
    private const AVAIL = 3;
    private const MOVES = 5;

    public function part1(string $input)
    {
        $grid = $this->parseInput($input);
        return array_sum(array_map(function (array $node) use ($grid): int {
            return $node[self::USED] ? array_sum(array_map($this->viable($node), $grid)) : 0;
        }, $grid));
    }

    public function part2(string $input)
    {
        return $this->gainDataAccess($input);
    }

    public function gainDataAccess(string $input): int
    {
        $nodes = $this->parseInput($input);
        $grid  = $this->getGrid($nodes);
        $from  = [0, max(array_column($nodes, 0))];
        $dist  = $from[1] - 1;
        return $this->findShortestPath($this->toMaze($grid)) + $dist * self::MOVES;
    }

    private function findShortestPath(string $maze): int
    {
        $goal = strpos($maze, 'G');
        $from = strpos($maze, '_');
        $max  = strlen($maze) - 1;
        $next = $this->next($maze);

        $seen  = [$from];
        $queue = [[0, $from]];
        while ($queue) {
            [$steps, $p] = array_shift($queue);
            foreach ($next($p) as $n) {
                if ($n === $goal) return $steps + 1;
                if ($n > $max || in_array($n, $seen) || $maze{$n} !== '.') continue;
                $seen[]  = $n;
                $queue[] = [$steps + 1, $n];
            }
        }
        return -1;
    }

    private function next(string $maze): callable
    {
        $width = strpos($maze, PHP_EOL) + 1;
        return function (int $point) use ($width): array {
            return [$point - 1, $point + 1, $point - $width, $point + $width];
        };
    }

    private function toMaze(array $grid): string
    {
        for ($y = 0, $maze = '', $maxY = count($grid); $y < $maxY; $y++) {
            for ($x = 0, $maxX = count($grid[$y]); $x < $maxX; $x++) {
                $offsets = [[-1, 0], [0, 1], [1, 0], [0, -1]];
                switch (true) {
                    case $grid[$y][$x][0] === 0:
                        $maze .= '_';
                        break;
                    case $y === 0 && $x === $maxX - 1:
                        $maze .= 'G';
                        break;
                    default:
                        foreach ($offsets as $o) {
                            [$x_, $y_] = [$x + $o[0], $y + $o[1]];
                            if (isset($grid[$y_][$x_]) && array_sum($grid[$y_][$x_]) < $grid[$y][$x][0]) {
                                $maze .= '#';
                                break 2;
                            }
                        }
                        $maze .= '.';
                        break;
                }
            }
            $maze .= PHP_EOL;
        }
        return $maze;
    }

    private function getGrid(array $nodes): array
    {
        for ($grid = [], $i = 0, $max = count($nodes); $i < $max; $i++) {
            $grid[$nodes[$i][1]][$nodes[$i][0]] = array_slice($nodes[$i], 2);
        }
        return $grid;
    }

    private function viable(array $node): callable
    {
        return function (array $other) use ($node): bool {
            return $node !== $other && $node[self::USED] <= $other[self::AVAIL];
        };
    }

    private function parseInput(string $input): array
    {
        return array_values(array_filter(array_map(function (string $line): array {
            preg_match('#^/dev/grid/node-x(\d+)-y(\d+)\s+\d+T\s+(\d+)T\s+(\d+)T#', $line, $match);
            return array_map('intval', array_slice($match, 1));
        }, explode(PHP_EOL, trim($input)))));
    }
}
