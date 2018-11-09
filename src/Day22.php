<?php

namespace Mzentrale\AdventOfCode;

class Day22 implements Puzzle
{
    const STATE_CLEAN    = 0;
    const STATE_WEAKENED = 1;
    const STATE_INFECTED = 2;
    const STATE_FLAGGED  = 3;

    public function part1(string $input)
    {
        return $this->work($input, 10000);
    }

    public function part2(string $input)
    {
    }

    public function parseInput(string $grid): array
    {
        $result = [];
        $center = floor(strpos($grid, "\n") / 2);
        foreach (explode("\n", trim($grid)) as $j => $row) {
            foreach (str_split($row) as $k => $cell) {
                $result[$j - $center][$k - $center] = $cell === '#';
            }
        }
        return $result;
    }

    public function work(string $gridData, int $iterations): int
    {
        $grid       = $this->parseInput($gridData);
        $position   = [0, 0];
        $direction  = 'u';
        $infections = 0;
        for ($i = 0; $i < $iterations; $i++) {
            $isInfected                       = $grid[$position[0]][$position[1]] ?? false;
            $grid[$position[0]][$position[1]] = !$isInfected;
            $infections                       += !$isInfected;
            switch ($direction) {
                case 'u':
                    $direction = $isInfected ? 'r' : 'l';
                    $position  = [$position[0], $position[1] + ($isInfected ? 1 : -1)];
                    break;
                case 'd':
                    $direction = $isInfected ? 'l' : 'r';
                    $position  = [$position[0], $position[1] + (!$isInfected ? 1 : -1)];
                    break;
                case 'l':
                    $direction = $isInfected ? 'u' : 'd';
                    $position  = [$position[0] + ($isInfected ? -1 : 1), $position[1]];
                    break;
                case 'r':
                    $direction = $isInfected ? 'd' : 'u';
                    $position  = [$position[0] + (!$isInfected ? -1 : 1), $position[1]];
                    break;
            }
        }

        return $infections;
    }

    private function debug(array $grid)
    {
        $y = [
            min(array_keys($grid)),
            max(array_keys($grid)),
        ];

        $x = [
            min(array_map('min', array_map('array_keys', $grid))),
            max(array_map('max', array_map('array_keys', $grid))),
        ];

        for ($j = $y[0]; $j <= $y[1]; $j++) {
            for ($k = $x[0]; $k <= $x[1]; $k++) {
                echo ($grid[$j][$k] ?? false) ? '#' : '.';
            }
            echo PHP_EOL;
        }
    }
}
