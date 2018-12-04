<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day1 implements Puzzle
{
    const NORTH = 0;
    const EAST  = 1;
    const SOUTH = 2;
    const WEST  = 3;

    public function part1(string $input)
    {
        return $this->getDistance($input);
    }

    public function part2(string $input)
    {
        return $this->getVisitedTwice($input);
    }

    public function getDistance(string $input): int
    {
        $position  = [0, 0];
        $direction = self::NORTH;
        foreach ($this->parseInput($input) as list($turn, $steps)) {
            $direction = ($direction + ($turn === 'R' ? +1 : -1) + 4) % 4;
            switch ($direction) {
                case self::NORTH:
                    $position = [$position[0] + $steps, $position[1]];
                    break;
                case self::EAST:
                    $position = [$position[0], $position[1] + $steps];
                    break;
                case self::SOUTH:
                    $position = [$position[0] - $steps, $position[1]];
                    break;
                case self::WEST:
                    $position = [$position[0], $position[1] - $steps];
                    break;
            }
        }
        return $this->distance($position);
    }

    public function getVisitedTwice(string $input): int
    {
        $position    = [0, 0];
        $direction   = self::NORTH;
        $visited     = [];
        $recordSteps = function (int $steps, int $direction, array $position) use (&$visited) {
            $steps     = $direction > self::EAST ? -$steps : $steps;
            $increment = $steps >= 0 ? 1 : -1;

            for ($i = $steps >= 0 ? 1 : -1; abs($i) <= abs($steps); $i += $increment) {
                switch ($direction) {
                    case self::NORTH:
                    case self::SOUTH:
                        $key = sprintf('%d:%d', $position[0] + $i, $position[1]);
                        break;
                    default:
                        $key = sprintf('%d:%d', $position[0], $position[1] + $i);
                        break;
                }

                if (in_array($key, $visited)) {
                    throw new \Exception($key);
                }
                $visited[] = $key;
            }
        };

        foreach ($this->parseInput($input) as list($turn, $steps)) {
            $direction = ($direction + ($turn === 'R' ? +1 : -1) + 4) % 4;
            try {
                $recordSteps($steps, $direction, $position);
            } catch (\Exception $e) {
                return $this->distance(explode(':', $e->getMessage()));
            }

            switch ($direction) {
                case self::NORTH:
                    $position = [$position[0] + $steps, $position[1]];
                    break;
                case self::EAST:
                    $position = [$position[0], $position[1] + $steps];
                    break;
                case self::SOUTH:
                    $position = [$position[0] - $steps, $position[1]];
                    break;
                case self::WEST:
                    $position = [$position[0], $position[1] - $steps];
                    break;
            }
        }

        return 0;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $step) {
            return sscanf($step, '%1s%d');
        }, explode(', ', trim($input)));
    }

    private function distance(array $position): int
    {
        return array_sum(array_map('abs', $position));
    }
}
