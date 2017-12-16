<?php

namespace Mzentrale\AdventOfCode;

class Day13 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getSeverity($input);
    }

    public function part2(string $input)
    {
        return $this->getDelay($input, 3833504);
    }

    public function getSeverity(string $input): int
    {
        $layers = $this->parseInput($input);
        return array_sum(array_map(function ($position) use ($layers) {
            return $position * $layers[$position];
        }, $this->getCaught($layers)));
    }

    public function getDelay(string $input, int $delay = 0): int
    {
        $layers = $this->parseInput($input);
        while (!empty($this->getCaught($layers, $delay, true))) {
            $delay++;
        }
        return $delay;
    }

    private function parseInput(string $input): array
    {
        return array_column(array_map(function (string $line): array {
            return explode(': ', $line);
        }, explode(PHP_EOL, trim($input))), 1, 0);
    }

    private function getPosition(int $time, int $range): int
    {
        $range -= 1;
        $time  = abs($time) % ($range * 2);
        return $time >= $range ? $range - ($time % $range) : $time % $range;
    }

    private function getCaught(array $layers, int $delay = 0, bool $earlyReturn = false): array
    {
        $depths = array_keys($layers);
        for ($time = $delay, $current = 0, $ride = max($depths), $caught = []; $current <= $ride; $time++, $current++) {
            $scanners = array_combine($depths, array_map(function ($depth) use ($time, $layers) {
                return $this->getPosition($time, $layers[$depth]);
            }, $depths));

            if (($scanners[$current] ?? -1) === 0) {
                $caught[] = $current;
                if ($earlyReturn) {
                    break;
                }
            }
        }
        return $caught;
    }
}
