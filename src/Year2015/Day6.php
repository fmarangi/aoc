<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day6 implements Puzzle
{
    public function part1(string $input)
    {
        $grid = $this->getGrid();
        foreach ($this->parseInput($input) as list($action, $from, $to)) {
            for ($y = $from[0]; $y <= $to[0]; $y++) {
                for ($x = $from[1]; $x <= $to[1]; $x++) {
                    switch ($action) {
                        case 'on':
                            $grid[$x][$y] = 1;
                            break;
                        case 'off':
                            $grid[$x][$y] = 0;
                            break;
                        case 'toggle':
                            $grid[$x][$y] = !$grid[$x][$y];
                            break;
                    }
                }
            }
        }
        return array_sum(array_map('array_sum', $grid));
    }

    public function part2(string $input)
    {
        $grid = $this->getGrid();
        foreach ($this->parseInput($input) as list($action, $from, $to)) {
            for ($y = $from[0]; $y <= $to[0]; $y++) {
                for ($x = $from[1]; $x <= $to[1]; $x++) {
                    switch ($action) {
                        case 'on':
                            $grid[$x][$y] += 1;
                            break;
                        case 'off':
                            if ($grid[$x][$y]) $grid[$x][$y] -= 1;
                            break;
                        case 'toggle':
                            $grid[$x][$y] += 2;
                            break;
                    }
                }
            }
        }
        return array_sum(array_map('array_sum', $grid));
    }

    private function getGrid(int $side = 1000): array
    {
        return array_fill(0, $side, array_fill(0, $side, 0));
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            $line = preg_replace('#^turn #', '', $line);
            list($action, $data) = explode(' ', $line, 2);
            list($from, $to) = explode(' through ', $data);
            return [$action, explode(',', $from), explode(',', $to)];
        }, explode(PHP_EOL, trim($input)));
    }
}
