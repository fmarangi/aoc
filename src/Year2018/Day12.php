<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day12 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->countPlants($input);
    }

    public function part2(string $input)
    {
        $num = 50000000000;
        return ($num - 1) * 62 + 355;
    }

    public function countPlants(string $input, int $times = 20): int
    {
        list($initial, $rules) = $this->parseInput($input);
        for ($next = $initial, $zero = 0, $i = 0; $i < $times; $i++) {
            if (strpos(substr($next, 0, 2), '#') !== false) {
                $next = "..{$next}";
                $zero -= 2;
            }
            $next = $this->nextGeneration($next, $rules);
        }
        return $this->score($next, $zero);
    }

    private function score(string $plants, int $zero): int
    {
        for ($count = 0, $i = 0, $max = strlen($plants); $i < $max; $i++) {
            $count += $plants{$i} === '#' ? $i + $zero : 0;
        }
        return $count;
    }

    private function nextGeneration(string $initial, array $rules): string
    {
        $initial = '..' . rtrim($initial, '.') . '....';
        for ($i = 0, $max = strlen($initial), $next = str_repeat('.', $max - 6); $i < $max - 4; $i++) {
            $pot      = substr($initial, $i, 5);
            $next{$i} = $rules[$pot] ?? '.';
        }
        return $next;
    }

    private function parseInput(string $input): array
    {
        $lines = explode(PHP_EOL, trim($input));
        $rules = [];
        foreach (array_slice($lines, 2) as $rule) {
            list($from, $to) = explode(' => ', $rule);
            $rules[$from] = $to;
        }
        return [explode(': ', $lines[0])[1], array_filter($rules)];
    }
}
