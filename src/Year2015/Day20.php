<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day20 implements Puzzle
{
    public function part1(string $input)
    {
        for ($i = 66500, $max = intval($input); $this->getPresents($i) < $max; $i++) {
            continue;
        }
        return $i;
    }

    public function part2(string $input)
    {
        for ($i = 66500, $max = intval($input); $this->getPresents($i, 11, 50) < $max; $i++) {
            continue;
        }
        return $i;
    }

    public function getDivisors(int $number): array
    {
        for ($i = 1, $divisors = [], $max = sqrt($number); $i <= $max; $i++) {
            if ($number % $i === 0) {
                $divisors[] = $i;
                $divisors[] = $number / $i;
            }
        }
        return array_unique($divisors);
    }

    public function getPresents(int $house, int $presents = 10, ?int $max = null): int
    {
        $divisors = $this->getDivisors($house);
        if ($max) {
            $divisors = array_filter($divisors, function (int $number) use ($house, $max) {
                return $house / $number <= $max;
            });
        }
        return array_sum($divisors) * $presents;
    }
}
