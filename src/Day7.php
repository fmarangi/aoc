<?php

namespace Mzentrale\AdventOfCode;

class Day7 implements Puzzle
{
    public function solve($input)
    {
        $lines    = array_map([$this, 'parse'], explode(PHP_EOL, trim($input)));
        $children = array_merge(...array_column($lines, 1));
        $parents  = array_values(array_diff(array_column($lines, 0), $children));
        return $parents[0] ?? null;
    }

    public function parse(string $line): array
    {
        $subs = strpos($line, '->') === false ? [] : array_map('trim', explode(',', explode('->', $line)[1]));
        return [explode(' ', trim($line))[0], $subs];
    }
}
