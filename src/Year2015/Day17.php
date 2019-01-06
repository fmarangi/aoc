<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day17 implements Puzzle
{
    public function part1(string $input)
    {
        return count($this->getCombinations($this->parseInput($input), 150));
    }

    public function part2(string $input)
    {
        return count($this->getMininumCombinations($this->parseInput($input), 150));
    }

    public function getCombinations(array $containers, int $liters): array
    {
        $open = $combos = [];
        foreach ($containers as $container) {
            for ($i = 0, $max = count($open); $i < $max; $i++) {
                $combo = array_merge($open[$i], [$container]);
                $sum   = array_sum($combo);
                switch (true) {
                    case $sum === $liters:
                        $combos[] = $combo;
                        break;
                    case $sum < $liters:
                        $open[] = $combo;
                        break;
                }
            }
            $open[] = [$container];
        }
        return $combos;
    }

    public function getMininumCombinations(array $containers, int $liters): array
    {
        $combos = $this->getCombinations($containers, $liters);
        $min    = min(array_map('count', $combos));
        return array_filter($combos, function (array $combo) use ($min) {
            return count($combo) === $min;
        });
    }

    private function parseInput(string $input): array
    {
        return array_map('intval', explode(PHP_EOL, trim($input)));
    }
}
