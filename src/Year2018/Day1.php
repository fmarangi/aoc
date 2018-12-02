<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day1 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->frequencyChange(trim($input));
    }

    public function part2(string $input)
    {
        return $this->findDuplicate(trim($input));
    }

    public function frequencyChange(string $changes, int $initial = 0)
    {
        return array_reduce($this->parseInput($changes), function (int $result, int $change) {
            return $result + $change;
        }, $initial);
    }

    public function findDuplicate(string $changes): int
    {
        $current     = 0;
        $frequencies = [0 => true];
        while (true) {
            foreach ($this->parseInput($changes) as $change) {
                $current += $change;
                if (isset($frequencies[$current])) {
                    return $current;
                }
                $frequencies[$current] = true;
            }
        }
    }

    private function parseInput(string $changes): array
    {
        return array_map('intval', explode(PHP_EOL, $changes));
    }
}
