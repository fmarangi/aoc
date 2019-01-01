<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day14 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->generateKeys(trim($input), 64);
    }

    public function part2(string $input)
    {
        return $this->generateKeys(trim($input), 64, 2016);
    }

    public function hash(string $string, int $stretch = 0): string
    {
        for ($i = 0, $result = $string; $i < $stretch + 1; $i++) $result = md5($result);
        return $result;
    }

    public function generateKeys(string $salt, int $keys, int $stretch = 0): int
    {
        $possible = $generated = [];

        $i = 0;
        while (true) {
            $hash = $this->hash($salt . $i, $stretch);

            $check = $this->find($hash, 5);
            if ($check !== '') {
                $possible = array_filter($possible, function ($index) use ($i) {
                    return $i - $index <= 1000;
                }, ARRAY_FILTER_USE_KEY);

                while (false !== ($key = array_search($check, $possible))) {
                    $generated[] = $key;
                    unset($possible[$key]);
                }

                if (count($generated) >= $keys * 2) { // In case a later check validates an earlier key
                    sort($generated);
                    return $generated[$keys - 1];
                }
            }

            $key = $this->find($hash, 3);
            if ($key !== '') $possible[$i] = $key;
            $i++;
        }
    }

    public function find(string $hash, int $qty): string
    {
        preg_match(sprintf('#(\w)\1{%d}#', $qty - 1), $hash, $match);
        return $match[1] ?? '';
    }
}
