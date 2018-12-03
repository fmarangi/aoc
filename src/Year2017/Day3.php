<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day3 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->distance((int) $input);
    }

    public function part2(string $input)
    {
        $target = (int) $input;
        $i      = 1;
        while ($this->getValue($i) < $target) {
            $i++;
        }
        return $this->getValue($i);
    }

    public function distance(int $square): int
    {
        if ($square === 1) {
            return 0;
        }

        $diameter = $this->getDiameter($square);
        $rel      = ($square - pow($diameter - 2, 2)) % ($diameter - 1);
        $radius   = floor($diameter / 2);
        return $radius + abs($rel - $radius);
    }

    private function getDiameter(int $square): int
    {
        return ceil(sqrt($square)) | 1;
    }

    public function getGrid(int $max): array
    {
        $grid = [];
        for ($i = 1, $x = 0, $y = 0, $dirs = 'RULD', $dir = 0; $i <= $max; $i++) {
            $grid[sprintf('%d:%d', $x, $y)] = $i;
            switch ($dirs[$dir % 4]) {
                case 'R':
                    $x++;
                    if (!isset($grid[sprintf('%d:%d', $x, $y + 1)])) {
                        $dir++;
                    }
                    break;
                case 'U':
                    $y++;
                    if (!isset($grid[sprintf('%d:%d', $x - 1, $y)])) {
                        $dir++;
                    }
                    break;
                case 'L':
                    $x--;
                    if (!isset($grid[sprintf('%d:%d', $x, $y - 1)])) {
                        $dir++;
                    }
                    break;
                case 'D':
                    $y--;
                    if (!isset($grid[sprintf('%d:%d', $x + 1, $y)])) {
                        $dir++;
                    }
                    break;
            }
        }
        return $grid;
    }

    public function getValue(int $square)
    {
        $grid = $this->emptyGrid($square);

        $grid['0:0'] = 1;
        foreach (array_keys($grid) as $position) {
            $grid[$position] = array_sum(array_map(function ($position) use ($grid) {
                return isset($grid[$position]) ? $grid[$position] : 0;
            }, $this->getAdjacent($position)));
        }
        return array_pop($grid);
    }

    private function emptyGrid(int $max): array
    {
        $grid = $this->getGrid($max);
        return array_combine(array_keys($grid), array_fill(0, count($grid), 0));
    }

    private function getAdjacent(string $position): array
    {
        list($x, $y) = explode(':', $position);
        $adjacent = [];
        for ($j = $x - 1; $j <= $x + 1; $j++) {
            for ($k = $y - 1; $k <= $y + 1; $k++) {
                $adjacent[] = "$j:$k";
            }
        }
        return $adjacent;
    }
}
