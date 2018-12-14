<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day10 implements Puzzle
{
    public function part1(string $input)
    {
        return strlen(array_reduce(range(1, 40), [$this, 'convert'], trim($input)));
    }

    public function part2(string $input)
    {
        return strlen(array_reduce(range(1, 50), [$this, 'convert'], trim($input)));
    }

    public function convert(string $string): string
    {
        for ($result = '', $i = 0, $char = $string{0}, $num = 0; isset($string{$i}); $i++) {
            if ($string{$i} !== $char) {
                $result .= $num . $char;
                $char   = $string{$i};
                $num    = 1;
                continue;
            }
            $num++;
        }
        return $result . $num . $string{$i - 1};
    }
}
