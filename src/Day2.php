<?php

namespace Mzentrale\AdventOfCode;

class Day2 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->checksum($input);
    }

    public function part2(string $input)
    {
        return $this->sumDivisible($input);
    }

    public function checksum($spreadsheet)
    {
        $lines = explode("\n", trim($spreadsheet));
        return array_sum(array_map(function ($line) {
            $numbers = array_map('intval', preg_split('#\s+#', $line));
            return max($numbers) - min($numbers);
        }, $lines));
    }

    public function sumDivisible($input): int
    {
        return array_sum(array_map(function ($row) {
            $divisible = $this->findDivisible(array_map('intval', preg_split('#\s+#', $row)));
            return $divisible[0] / $divisible[1];
        }, explode(PHP_EOL, trim($input))));
    }

    public function findDivisible(array $row): array
    {
        sort($row);
        while ($current = array_pop($row)) {
            foreach ($row as $other) {
                if ($current % $other === 0) {
                    return [$current, $other];
                }
            }
        }
        return [];
    }
}
