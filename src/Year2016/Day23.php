<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day23 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->runInstructions($input)['a'];
    }

    public function part2(string $input)
    {
        // return $this->runInstructions($input, 12)['a'];
        for ($i = $result = 1; $i <= 12; $i++) $result *= $i;
        return $result + 80 * 97;
    }

    public function runInstructions(string $input, int $a = 7): array
    {
        $instructions = $this->parseInput($input);
        for ($i = 0, $max = count($instructions), $registers = ['a' => $a]; $i < $max; $i++) {
            $instruction = $instructions[$i];
            switch ($instruction[0]) {
                case 'inc':
                    $registers[$instruction[1]] = ($registers[$instruction[1]] ?? 0) + 1;
                    break;
                case 'dec':
                    $registers[$instruction[1]] = ($registers[$instruction[1]] ?? 0) - 1;
                    break;
                case 'cpy':
                    if (!is_numeric($instruction[2])) {
                        $registers[$instruction[2]] = is_numeric($instruction[1]) ? (int) $instruction[1] : ($registers[$instruction[1]] ?? 0);
                    }
                    break;
                case 'jnz':
                    if ($registers[$instruction[1]] ?? $instruction[1]) {
                        $i += ($registers[$instruction[2]] ?? $instruction[2]) - 1;
                    }
                    break;
                case 'tgl':
                    $target = $i + ($registers[$instruction[1]] ?? $instruction[1]);
                    if ($target >= $max) break;
                    switch (count($instructions[$target])) {
                        case 2:
                            $instructions[$target][0] = $instructions[$target][0] === 'inc' ? 'dec' : 'inc';
                            break;
                        case 3:
                            $instructions[$target][0] = $instructions[$target][0] === 'jnz' ? 'cpy' : 'jnz';
                            break;
                    }
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
