<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day19 implements Puzzle
{
    /** @var Day16\Opcodes */
    private $opcodes;

    public function __construct()
    {
        $this->opcodes = new Day16\Opcodes();
    }

    public function part1(string $input)
    {
        // return $this->runInstructions($input)[0];
        return array_sum($this->getDivisors(930));
    }

    public function part2(string $input)
    {
        return array_sum($this->getDivisors(10551330));
    }

    private function getDivisors(int $num): array
    {
        for ($i = 1, $max = sqrt($num) + 1, $div = []; $i < $max; $i++) {
            if ($num % $i === 0) {
                $div[] = $i;
                $div[] = $num / $i;
            }
        }
        return array_values(array_unique($div));
    }

    public function runInstructions(string $input): array
    {
        $registers = array_fill(0, 6, 0);
        [$reg, $instructions] = $this->parseInput($input);
        for ($ip = $registers[$reg], $max = count($instructions); $ip < $max; $ip++) {
            $registers[$reg] = $ip;
            $registers = $this->run($instructions[$ip], $registers);
            $ip = $registers[$reg];
        }
        return $registers;
    }

    private function parseInput(string $input): array
    {
        $lines = explode(PHP_EOL, trim($input));
        $instructions = array_map(function (string $line): array {
            return sscanf($line, '%s %d %d %d');
        }, array_slice($lines, 1));
        return [(int) $lines[0]{4}, $instructions];
    }

    private function run(array $instructions, array $registers): array
    {
        return $this->opcodes->all()[$instructions[0]]($instructions, $registers);
    }
}
