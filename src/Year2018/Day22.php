<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day22 implements Puzzle
{
    const ROCKY  = 0;
    const WET    = 1;
    const NARROW = 2;

    const TORCH         = 0;
    const CLIMBING_GEAR = 1;
    const NEITHER       = 2;

    private $forbidden = [
        self::TORCH         => self::WET,
        self::CLIMBING_GEAR => self::NARROW,
        self::NEITHER       => self::ROCKY,
    ];

    public function part1(string $input)
    {
        return $this->getRiskLevel(...$this->parseInput($input));
    }

    public function part2(string $input)
    {
        return $this->getFastestWay(...$this->parseInput($input));
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

    public function getFastestWay(int $x, int $y, int $depth, int $gutter = 20): int
    {
        $goal  = sprintf('%d:%d:%d', $x, $y, self::TORCH);
        $next  = $this->next($this->getCave($x, $y, $depth, $gutter));
        $paths = [[0, '0:0:' . self::TORCH], [7, '0:0:' . self::CLIMBING_GEAR]];

        $seen = [];
        while ($paths) {
            [$time, $pos] = array_shift($paths);
            if ($pos === $goal) return $time;
            if (in_array($pos, $seen)) continue;
            $seen[] = $pos;

            $sort = false;
            [$x_, $y_, $tool] = explode(':', $pos);
            foreach ($next($x_, $y_) as list($p, $region)) {
                if (!$this->canUse($tool, $region)) continue;
                $paths[] = [$time + 1, "{$p}:{$tool}"];
                $paths[] = [$time + 8, "{$p}:{$this->switchTool($tool, $region)}"];
                $sort    = true;
            }

            if (!$sort) continue;
            usort($paths, function (array $a, array $b): int {
                return $a[0] - $b[0];
            });
        }

        return -1;
    }

    private function next(array $cave): callable
    {
        return function (int $x, int $y) use ($cave): array {
            $options = array_map(function (array $offset) use ($x, $y) {
                return [$x + $offset[0], $y + $offset[1]];
            }, [[-1, 0], [0, -1], [1, 0], [0, 1]]);

            $next = [];
            foreach ($options as list($x_, $y_)) {
                if (isset($cave[$y_][$x_])) {
                    $next[] = ["{$x_}:{$y_}", $cave[$y_][$x_]];
                }
            }
            return $next;
        };
    }

    private function canUse(int $tool, int $region): bool
    {
        return $region !== $this->forbidden[$tool];
    }

    private function switchTool(int $tool, int $region): int
    {
        return current(array_filter(array_keys($this->forbidden), function (int $t) use ($tool, $region) {
            return $t !== $tool && $this->canUse($t, $region);
        }));
    }

    private function getCave(int $x, int $y, int $depth, int $gutter = 0): array
    {
        $cave = $levels = [];
        for ($j = 0; $j <= $x + $gutter; $j++) {
            for ($k = 0; $k <= $y + $gutter; $k++) {
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
