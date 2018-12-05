<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day5 implements Puzzle
{
    public function part1(string $input)
    {
        return strlen($this->getPolymer(trim($input)));
    }

    public function part2(string $input)
    {
        return $this->getImprovedPolymer(trim($input));
    }

    public function getPolymer(string $start): string
    {
        while (true) {
            for ($i = 0, $prev = '', $result = '', $num = strlen($start); $i < $num; $i++) {
                if (strtolower($start{$i}) === strtolower($prev) && ord($start{$i}) !== ord($prev)) {
                    $result = substr($result, 0, -1);
                    $prev   = '';
                    continue;
                }
                $result .= $start{$i};
                $prev   = $start{$i};
            }

            if ($result === $start) {
                break;
            }

            $start = $result;
        }
        return $start;
    }

    public function getImprovedPolymer(string $start): int
    {
        $min = strlen($start);
        foreach (range('a', 'z') as $unit) {
            $result = $this->getPolymer(str_replace([$unit, strtoupper($unit)], '', $start));
            $min    = strlen($result) < $min ? strlen($result) : $min;
        }
        return $min;
    }
}
