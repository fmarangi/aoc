<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day8 implements Puzzle
{
    public function part1(string $input)
    {
        return array_sum(array_map(function (string $string) {
            return strlen($string) - $this->getStringDataLength($string);
        }, explode(PHP_EOL, trim($input))));
    }

    public function part2(string $input)
    {
        return array_sum(array_map(function (string $string) {
            return strlen($this->encode($string)) - strlen($string);
        }, explode(PHP_EOL, trim($input))));
    }

    public function getStringDataLength(string $string): int
    {
        return strlen($this->decode($string));
    }

    private function decode(string $string): string
    {
        $string = substr($string, 1, -1);
        $string = str_replace(['\"', '\\\\'], ['"', '\\'], $string);
        return preg_replace_callback('#\\\x([0-9a-f]{2})#', function (array $match) {
            return chr(hexdec($match[1]));
        }, $string);
    }

    private function encode(string $string): string
    {
        return '"' . str_replace(['\\', '"'], ['\\\\', '\"'], $string) . '"';
    }
}
