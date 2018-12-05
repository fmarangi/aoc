<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day6 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->recoverMessage($input);
    }

    public function part2(string $input)
    {
        return $this->recoverMessage($input, false);
    }

    public function recoverMessage(string $input, bool $mostCommon = true): string
    {
        $message = '';
        $lines   = array_map('str_split', explode(PHP_EOL, trim($input)));
        for ($i = 0, $num = count($lines[0]); $i < $num; $i++) {
            $column = array_column($lines, $i);
            $counts = [];
            foreach ($column as $char) {
                $counts[$char] = ($counts[$char] ?? 0) + 1;
            }
            $message .= array_search($mostCommon ? max($counts) : min($counts), $counts);
        }
        return $message;
    }
}
