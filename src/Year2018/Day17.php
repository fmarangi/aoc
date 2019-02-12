<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day17 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getWaterTiles($input);
    }

    public function part2(string $input)
    {
        return $this->getWaterTilesAfter($input);
    }

    public function getWaterTiles(string $input): int
    {
        $ground  = $this->fillWithWater($input);
        $width   = strpos($ground, PHP_EOL) + 1;
        $lowestY = intdiv(strpos($ground, '#'), $width) - 1;
        return substr_count($ground, '|') - $lowestY;
    }

    public function getWaterTilesAfter(string $input): int
    {
        $ground = $this->drain($this->drain($this->fillWithWater($input)));
        return substr_count($ground, '~');
    }

    private function fillWithWater(string $input): string
    {
        $ground = $this->parseInput($input);
        $spring = strpos($ground, '+');
        $width  = strpos($ground, PHP_EOL) + 1;

        $i = 0;
        $from = [$spring];
        while ($from) {
            [$ground, $next] = $this->fill(array_shift($from), $ground, $width);

            $next = array_diff($next, $from);
            if ($next) array_push($from, ...$next);
        }
        return $ground;
    }

    private function fill(int $from, string $ground, int $width): array
    {
        for ($current = $from + $width; isset($ground{$current}) && $ground{$current} === '.'; $current += $width) {
            $ground{$current} = '|';
        }

        $overAt = [];
        switch (true) {
            case !isset($ground{$current}):
            case $ground{$current} === '|' && !$this->isContained($current, $ground):
                break;

            default:
                $border = false;
                while (!$border) {
                    $current -= $width;
                    for ($i = $current; $ground{$i - 1} !== '#'; $i--) {
                        if ($ground{$i + $width} === '.') {
                            $ground{$i} = '|';
                            $border = true;
                            $overAt[] = $i++;
                            break;
                        }
                    }

                    for (; $ground{$i} !== '#'; $i++) {
                        $ground{$i} = '|';
                        if ($ground{$i + $width} === '.') {
                            $border = true;
                            $overAt[] = $i;
                            break;
                        }
                    }
                }
                break;
        }

        return [$ground, $overAt];
    }

    private function isContained(int $from, string $ground): bool
    {
        for ($i = $from; $ground{$i} === '|'; $i--) continue;
        return $ground{$i} === '#' && strpos($ground, '#', $i + 1) < strpos($ground, '.', $i + 1);
    }

    private function drain(string $ground): string
    {
        return preg_replace_callback('@#\|+#@', function (array $hit): string {
            return '#' . str_repeat('~', strlen($hit[0]) - 2) . '#';
        }, $ground);
    }

    private function parseInput(string $input, int $spring = 500): string
    {
        // Map all lines to ranges for both axes
        $lines = array_map(function (string $line): array {
            preg_match('#^(x|y)=([0-9\.]+?), (x|y)=([0-9\.]+?)$#', $line, $match);
            [$x, $y] = $match[1] === 'x' ? [$match[2], $match[4]] : [$match[4], $match[2]];
            [$x, $y] = [strpos($x, '..') ? $x : "$x..$x", strpos($y, '..') ? $y : "$y..$y"];
            return [explode('..', $x), explode('..', $y)];
        }, explode(PHP_EOL, trim($input)));

        // Find corners (min x, max x, max y)
        $corners = array_reduce($lines, function (array $result, array $wall): array {
            return [
                min($result[0], min($wall[0])),
                max($result[1], max($wall[0])),
                max($result[2], max($wall[1])),
            ];
        }, [99999, 0, 0]);

        // Draw walls
        $zero   = $corners[0] - 1;
        $width  = $corners[1] - $zero + 2;
        $ground = array_reduce($lines, function (string $result, array $wall) use ($width, $zero): string {
            for ($x = $wall[0][0]; $x <= $wall[0][1]; $x++) {
                for ($y = $wall[1][0]; $y <= $wall[1][1]; $y++) {
                    $pos = ($width + 1) * $y + $x - $zero;
                    $result{$pos} = '#';
                }
            }
            return $result;
        }, str_repeat(str_repeat('.', $width) . PHP_EOL, $corners[2] + 1));

        // Add spring
        $ground{$spring - $zero} = '+';
        return $ground;
    }
}
