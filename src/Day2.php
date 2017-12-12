<?php

namespace Mzentrale\AdventOfCode;

class Day2 implements Puzzle
{
    public function checksum($spreadsheet)
    {
        $lines = explode("\n", trim($spreadsheet));
        return array_sum(array_map(function ($line) {
            $numbers = array_map('intval', preg_split('#\s+#', $line));
            return max($numbers) - min($numbers);
        }, $lines));
    }

    public function solve($input)
    {
        return $this->checksum($input);
    }
}
