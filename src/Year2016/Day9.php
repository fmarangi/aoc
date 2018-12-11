<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day9 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->decompress($input);
    }

    public function part2(string $input)
    {
        return $this->decompress($input, true);
    }

    public function decompress(string $string, bool $recursive = false): int
    {
        $length = 0;
        while (($start = strpos($string, '(')) !== false) {
            $length += $start;
            $end    = strpos($string, ')', $start);
            list($chars, $times) = explode('x', substr($string, $start + 1, $end - $start - 1));
            $decompress = str_repeat(substr($string, $end + 1, $chars), $times);
            $length     += $recursive ? $this->decompress($decompress, true) : strlen($decompress);
            $string     = substr($string, $end + 1 + $chars);
        }
        return $length + strlen(trim($string));
    }
}
