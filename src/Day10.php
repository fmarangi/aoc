<?php

namespace Mzentrale\AdventOfCode;

class Day10 implements Puzzle
{
    public function solve($input)
    {
        return $this->factor(explode(',', trim($input)));
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
        $count   = count($list);
        $sublist = [];
        for ($i = 0; $i < $length; $i++) {
            $sublist[] = $list[($i + $position) % $count];
        }

        $reverse = array_reverse($sublist);
        foreach ($reverse as $i => $number) {
            $list[($i + $position) % $count] = $number;
        }
        return $list;
    }
}
