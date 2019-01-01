<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day16 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->checksum(trim($input), 272);
    }

    public function part2(string $input)
    {
        return $this->checksum(trim($input), 35651584);
    }

    public function transform(string $input): string
    {
        return $input . '0' . strtr(strrev($input), '10', '01');
    }

    public function checksum(string $input, int $length): string
    {
        while (strlen($input) < $length) $input = $this->transform($input);
        for ($checksum = '', $i = 0; $i < $length; $i += 2) {
            $checksum .= $input{$i} === $input{$i + 1} ? '1' : '0';
        }
        return strlen($checksum) % 2 === 0 ? $this->checksum($checksum, strlen($checksum)) : $checksum;
    }
}
