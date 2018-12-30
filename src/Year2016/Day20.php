<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day20 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getLowestAllowedIp($input);
    }

    public function part2(string $input)
    {
        return $this->getAllowed($input);
    }

    public function getLowestAllowedIp(string $input): int
    {
        $ranges = $this->parseInput($input);
        return array_reduce($ranges, function (int $result, array $range): int {
            return $result < $range[0] ? $result : $range[1] + 1;
        }, 0);
    }

    public function getAllowed(string $input): int
    {
        $notAllowed = array_sum(array_map(function (array $range): int {
            return $range[1] - $range[0] + 1;
        }, $this->simplify($input)));
        return pow(2, 32) - $notAllowed;
    }

    public function simplify(string $input): array
    {
        $ranges = [];
        foreach ($this->parseInput($input) as list($min, $max)) {
            foreach ($ranges as &$range) {
                if ($max < $range[1]) {
                    continue 2;
                }

                if ($min < $range[1]) {
                    $range[1] = $max;
                    continue 2;
                }
            }
            $ranges[] = [$min, $max];
        }
        return $ranges;
    }

    private function parseInput(string $input): array
    {
        $ranges = array_map(function (string $line): array {
            return sscanf($line, '%d-%d');
        }, explode(PHP_EOL, trim($input)));
        usort($ranges, function (array $a, array $b) {
            return $a[0] <=> $b[0];
        });
        return $ranges;
    }
}
