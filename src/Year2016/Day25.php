<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day25 implements Puzzle
{
    public function part1(string $input)
    {
        for ($i = 0; !$this->runInstructions($input, $i); $i++) continue;
        return $i;
    }

    public function part2(string $input)
    {
    }

    public function runInstructions(string $input, int $a): bool
    {
        $registers      = array_combine(range('a', 'd'), array_fill(0, 4, 0));
        $registers['a'] = $a;

        $instructions = $this->parseInput($input);
        for ($i = $expect = 0, $max = count($instructions); $i < $max; $i++) {
            switch ($instructions[$i][0]) {
                case 'inc':
                    $registers[$instructions[$i][1]] += 1;
                    break;
                case 'dec':
                    $registers[$instructions[$i][1]] -= 1;
                    break;
                case 'cpy':
                    $what = $instructions[$i][1];
                    $registers[$instructions[$i][2]] = ($registers[$what] ?? (int) $what);
                    break;
                case 'jnz':
                    $what = $instructions[$i][1];
                    if (($registers[$what] ?? (int) $what) !== 0) $i += $instructions[$i][2] - 1;
                    break;
                case 'out':
                    if ($registers[$instructions[$i][1]] !== $expect % 2) return false;
                    $expect++;
                    break;
            }

            if ($expect > 1000) break;
        }
        return true;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return explode(' ', $line);
        }, explode(PHP_EOL, trim($input)));
    }
}
