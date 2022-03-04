<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day10 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->factor(explode(',', trim($input)));
    }

    public function part2(string $input)
    {
        return $this->hash(trim($input));
    }

    public function factor(array $lengths, int $numItems = 256): int
    {
        $list     = range(0, $numItems - 1);
        $position = 0;
        $skip     = 0;
        foreach ($lengths as $length) {
            $list     = $this->apply($list, $position, $length);
            $position += ($length + $skip++) % $numItems;
        }
        return $list[0] * $list[1];
    }

    public function apply(array $list, int $position, int $length): array
    {
        for ($i = 0, $count = count($list); $i < intdiv($length, 2); $i++) {
            $a = ($position + $i) % $count;
            $b = ($position + $length - $i - 1) % $count;
            [$list[$a], $list[$b]] = [$list[$b], $list[$a]];
        }
        return $list;
    }

    public function hash(string $input): string
    {
        $dense = array_map(function ($numbers) {
            return array_reduce($numbers, function ($result, $number) {
                return $result ^ $number;
            }, 0);
        }, $this->getSparseHash($this->getLengths($input)));
        return implode('', array_map(function ($num) {
            return sprintf('%02x', $num);
        }, $dense));
    }

    private function getLengths(string $input): array
    {
        return array_merge(array_filter(array_map('ord', str_split($input))), [17, 31, 73, 47, 23]);
    }

    private function getSparseHash(array $lengths, int $numItems = 256, int $repeat = 64): array
    {
        $list = range(0, $numItems - 1);
        for ($i = 0, $position = 0, $skip = 0; $i < $repeat; $i++) {
            foreach ($lengths as $length) {
                $list     = $this->apply($list, $position, $length);
                $position += ($length + $skip++) % $numItems;
            }
        }
        return array_chunk($list, 16);
    }
}
