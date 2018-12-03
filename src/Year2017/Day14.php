<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day14 implements Puzzle
{
    private $knot;

    public function __construct()
    {
        $this->knot = new Day10();
    }

    public function part1(string $input)
    {
        return $this->getUsedSquares(trim($input));
    }

    public function part2(string $input)
    {
        return $this->getRegions(trim($input));
    }

    public function getUsedSquares(string $key): int
    {
        $grid = implode(PHP_EOL, $this->getGrid($key));
        return strlen($grid) - strlen(str_replace('1', '', $grid));
    }

    public function getRegions(string $key): int
    {
        $grid = array_map(function ($line) {
            return str_split($line);
        }, $this->getGrid($key));

        $regions = 0;
        while ($one = $this->findOne($grid)) {
            $grid = $this->clearRegion($one, $grid);
            $regions++;
        }

        return $regions;
    }

    private function findOne(array $grid): array
    {
        foreach ($grid as $y => $line) {
            foreach ($line as $x => $char) {
                if ($char === '1') {
                    return [$y, $x];
                }
            }
        }
        return [];
    }

    private function getGrid(string $key): array
    {
        return array_map(function ($i) use ($key) {
            return implode('', array_map(function (string $part) {
                return sprintf('%04b', hexdec($part));
            }, str_split($this->knot->hash($key . '-' . $i))));
        }, range(0, 127));
    }

    private function clearRegion(array $one, array $grid)
    {
        list($y, $x) = $one;
        $grid[$y][$x] = '0';
        foreach ([-1, 1] as $j) {
            if (($grid[$y + $j][$x] ?? '0') === '1') {
                $grid = $this->clearRegion([$y + $j, $x], $grid);
            }
        }
        foreach ([-1, 1] as $j) {
            if (($grid[$y][$x + $j] ?? '0') === '1') {
                $grid = $this->clearRegion([$y, $x + $j], $grid);
            }
        }
        return $grid;
    }
}
