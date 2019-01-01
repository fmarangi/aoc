<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day15 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->pressButton($input);
    }

    public function part2(string $input)
    {
        return $this->pressButton($input . 'Disc #7 has 11 positions; at time=0, it is at position 0.');
    }

    public function pressButton(string $input): int
    {
        $discs = $this->parseInput($input);
        for ($i = 0; !$this->getCapsule($i, $discs); $i++) {
            continue;
        }
        return $i;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return sscanf($line, 'Disc #%d has %d positions; at time=0, it is at position %d.');
        }, explode(PHP_EOL, trim($input)));
    }

    private function getCapsule(int $time, array $discs): bool
    {
        foreach ($discs as list($distance, $positions, $initial)) {
            if (($time + $distance + $initial) % $positions !== 0) return false;
        }
        return true;
    }
}
