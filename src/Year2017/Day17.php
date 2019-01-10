<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day17 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getValueAfter((int) $input, 2017);
    }

    public function part2(string $input)
    {
        return $this->findValueAt((int) $input, 1, 50000000);
    }

    public function getValueAfter(int $steps, int $value = 2017): int
    {
        $sequence = $this->spinlock($steps, $value);
        return $sequence[array_search($value, $sequence) + 1];
    }

    public function findValueAt(int $steps, int $position, int $after): int
    {
        for ($i = 1, $current = 0, $value = 0; $i <= $after; $i++) {
            $current = 1 + ($current + $steps) % $i;
            if ($current === $position) {
                $value = $i;
            }
        }
        return $value;
    }

    public function spinlock(int $steps, int $repeat)
    {
        $sequence = [0];
        for ($i = 1, $current = 0; $i <= $repeat; $i++) {
            $current  = 1 + ($current + $steps) % $i;
            array_splice($sequence, $current, 0, [$i]);
        }
        return $sequence;
    }
}
