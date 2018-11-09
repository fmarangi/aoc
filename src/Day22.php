<?php

namespace Mzentrale\AdventOfCode;

class Day22 implements Puzzle
{
    const STATE_CLEAN    = 0;
    const STATE_WEAKENED = 1;
    const STATE_INFECTED = 2;
    const STATE_FLAGGED  = 3;

    const DIRECTION_UP    = 0;
    const DIRECTION_RIGHT = 1;
    const DIRECTION_DOWN  = 2;
    const DIRECTION_LEFT  = 3;

    public function part1(string $input)
    {
        return $this->work($input, 10000);
    }

    public function part2(string $input)
    {
        return $this->work2($input, 10000000);
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

    private function parseInput2(string $grid): array
    {
        $result = [];
        $center = floor(strpos($grid, "\n") / 2);
        foreach (explode("\n", trim($grid)) as $j => $row) {
            foreach (str_split($row) as $k => $cell) {
                $result[$j - $center][$k - $center] = $cell === '#' ? self::STATE_INFECTED : self::STATE_CLEAN;
            }
        }
        return $result;
    }


    public function work(string $gridData, int $iterations): int
    {
        $grid       = $this->parseInput($gridData);
        $position   = [0, 0];
        $direction  = self::DIRECTION_UP;
        $infections = 0;
        for ($i = 0; $i < $iterations; $i++) {
            $isInfected                       = $grid[$position[0]][$position[1]] ?? false;
            $grid[$position[0]][$position[1]] = !$isInfected;
            $infections                       += !$isInfected;

            $direction = $this->getNewDirection($direction, $isInfected ? 1 : -1);
            $position  = $this->getNewPosition($position, $direction);
        }

        return $infections;
    }

    public function work2(string $gridData, int $iterations): int
    {
        $grid       = $this->parseInput2($gridData);
        $position   = [0, 0];
        $direction  = self::DIRECTION_UP;
        $infections = 0;
        $move       = [
            self::STATE_CLEAN    => -1,
            self::STATE_INFECTED => 1,
            self::STATE_FLAGGED  => 2,
        ];
        for ($i = 0; $i < $iterations; $i++) {
            $state                            = $grid[$position[0]][$position[1]] ?? self::STATE_CLEAN;
            $newState                         = ($state + 1) % 4;
            $grid[$position[0]][$position[1]] = $newState;
            $infections                       += $newState === self::STATE_INFECTED;

            $direction = $this->getNewDirection($direction, $move[$state] ?? 0);
            $position  = $this->getNewPosition($position, $direction);
        }

        return $infections;
    }

    private function getNewDirection(int $current, int $move): int
    {
        return ($current + 4 + $move) % 4;
    }

    private function getNewPosition(array $current, int $direction): array
    {
        switch ($direction) {
            case self::DIRECTION_UP:
            case self::DIRECTION_DOWN:
                return [$current[0] + ($direction === self::DIRECTION_UP ? -1 : 1), $current[1]];
            case self::DIRECTION_RIGHT:
            case self::DIRECTION_LEFT:
                return [$current[0], $current[1] + ($direction === self::DIRECTION_LEFT ? -1 : 1)];
        }
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
