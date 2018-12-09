<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day4 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getCode(trim($input));
    }

    public function part2(string $input)
    {
        return $this->getCode(trim($input), '000000');
    }

    public function getCode(string $secretKey, string $match = '00000'): int
    {
        $i = 1;
        for ($len = strlen($match); substr(md5($secretKey . $i), 0, $len) !== $match; $i++) {
            continue;
        }
        return $i;
    }
}
