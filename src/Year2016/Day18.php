<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day18 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getSafe(trim($input), 40);
    }

    public function part2(string $input)
    {
        return $this->getSafe(trim($input), 400000);
    }

    public function getNextRow(string $row): string
    {
        $isTrap = array_combine(['.^^', '^^.', '^..', '..^'], array_fill(0, 4, true));
        for ($max = strlen($row), $row = ".{$row}.", $i = 1, $next = ''; $i <= $max; $i++) {
            $next .= isset($isTrap[substr($row, $i - 1, 3)]) ? '^' : '.';
        }
        return $next;
    }

    public function getSafe(string $first, int $rows): int
    {
        for ($i = 1, $map = $next = $first; $i < $rows; $i++) {
            $next = $this->getNextRow($next);
            $map  .= PHP_EOL . $next;
        }
        return substr_count($map, '.');
    }
}
