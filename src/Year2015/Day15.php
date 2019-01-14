<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day15 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getHighestScore($input);
    }

    public function part2(string $input)
    {
        return $this->getHighestScore($input, 500);
    }

    public function getHighestScore(string $input, int $calories = -1): int
    {
        $ingredients = $this->parseInput($input);

        $max = 0;
        foreach ($this->combinations() as $qty) {
            $use = $calories < 0 || $this->calories($ingredients, $qty) === $calories;
            $max = max($max, $use ? $this->getScore($ingredients, $qty) : $max);
        }
        return $max;
    }

    private function calories(array $ingredients, array $qty): int
    {
        for ($calories = $i = 0, $c = count($ingredients); $i < $c; $i++) {
            $calories += $qty[$i] * $ingredients[$i][5];
        }
        return $calories;
    }

    private function getScore(array $ingredients, array $qty): int
    {
        $scores = array_map(function (int $i) use ($ingredients, $qty) {
            for ($sum = $q = 0, $c = count($ingredients); $q < $c; $q++) {
                $sum += $qty[$q] * $ingredients[$q][$i];
            }
            return $sum;
        }, range(1, 4));
        return array_reduce($scores, function (int $product, int $score): int {
            return $product * ($score > 0 ? $score : 0);
        }, 1);
    }

    private function combinations(): \Iterator
    {
        for ($max = $x = 0; $x <= 100; $x++) {
            for ($y = 0; $y <= 100 - $x; $y++) {
                for ($z = 0; $z <= 100 - $x - $y; $z++) {
                    yield [$x, $y, $z, 100 - $x - $y - $z];
                }
            }
        }
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            $fmt = '%s capacity %d, durability %d, flavor %d, texture %d, calories %d';
            return sscanf(str_replace(':', '', $line), $fmt);
        }, explode(PHP_EOL, trim($input)));
    }
}
