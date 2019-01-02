<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day18 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->countLights(trim($input), 100);
    }

    public function part2(string $input)
    {
        return $this->countLights(trim($input), 100, true);
    }

    public function nextState(string $grid): string
    {
        $rows = explode(PHP_EOL, trim($grid));
        for ($y = 0, $next = '', $maxY = count($rows); $y < $maxY; $y++) {
            for ($x = 0, $maxX = strlen($rows[$y]); $x < $maxX; $x++) {
                $next .= $this->next($rows[$y]{$x}, $this->getNeighbours($rows, $x, $y));
            }
            $next .= PHP_EOL;
        }
        return trim($next);
    }

    public function countLights(string $grid, int $steps, bool $stuck = false): int
    {
        for ($i = 0; $i < $steps; $i++) {
            $grid = $this->nextState($stuck ? $this->stuck($grid) : $grid, $stuck);
        }
        return substr_count($stuck ? $this->stuck($grid) : $grid, '#');
    }

    public function stuck(string $grid): string
    {
        $grid = trim($grid);
        $eol  = strpos($grid, PHP_EOL);

        $grid{0} = '#';
        $grid{$eol - 1} = '#';
        $grid{-$eol} = '#';
        $grid{-1} = '#';

        return $grid;
    }

    private function next(string $current, string $neighbours): string
    {
        $on = substr_count($neighbours, '#');
        if ($current === '#') return $on === 2 || $on === 3 ? '#' : '.';
        return $on === 3 ? '#' : '.';
    }

    private function getNeighbours(array $grid, int $x, int $y): string
    {
        [$maxX, $maxY] = [strlen($grid[$y]), count($grid)];
        for ($neighbours = '', $j = -1; $j <= 1; $j++) {
            for ($k = -1; $k <= 1; $k++) {
                if (($j === 0 && $k === 0) || $y + $j < 0 || $x + $k < 0 || $y + $j >= $maxY || $x + $k >= $maxX) {
                    continue;
                }
                $neighbours .= $grid[$y + $j]{$x + $k};
            }
        }
        return $neighbours;
    }
}
