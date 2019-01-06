<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day23 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->runInstructions($input)['b'];
    }

    public function part2(string $input)
    {
        return $this->runInstructions($input, 1)['b'];
    }

    public function runInstructions(string $input, int $a = 0): array
    {
        $registers      = array_combine(range('a', 'b'), array_fill(0, 2, 0));
        $registers['a'] = $a;
        $instructions   = $this->parseInput($input);
        for ($i = 0, $max = count($instructions); $i < $max; $i++) {
            switch ($instructions[$i][0]) {
                case 'hlf':
                    $registers[$instructions[$i][1]] /= 2;
                    break;
                case 'tpl':
                    $registers[$instructions[$i][1]] *= 3;
                    break;
                case 'inc':
                    $registers[$instructions[$i][1]] += 1;
                    break;
                case 'jmp':
                    $i += $instructions[$i][1] - 1;
                    break;
                case 'jie':
                    $what = $instructions[$i][1]{0};
                    if ($registers[$what] % 2 === 0) $i += $instructions[$i][2] - 1;
                    break;
                case 'jio':
                    $what = $instructions[$i][1]{0};
                    if ($registers[$what] === 1) $i += $instructions[$i][2] - 1;
                    break;
            }
        }
        return $registers;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return explode(' ', $line);
        }, explode(PHP_EOL, trim($input)));
    }
}
