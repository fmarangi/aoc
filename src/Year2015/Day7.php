<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day7 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->runInstructions($input)['a'];
    }

    public function part2(string $input)
    {
        return $this->runInstructions($input, 46065)['a'];
    }

    public function runInstructions(string $input, ?int $valueForB = null): array
    {
        $wires = [];
        $instructions = $this->parseInput($input);
        while ($instructions) {
            for ($i = 0, $next = [], $c = count($instructions); $i < $c; $i++) {
                $current = $instructions[$i];
                switch (true) {
                    case count($current) === 2 && is_numeric($current[0]):
                        $wires[$current[1]] = $current[1] === 'b' && $valueForB ? $valueForB : (int) $current[0];
                        break;
                    case count($current) === 2 && isset($wires[$current[0]]):
                        $wires[$current[1]] = $wires[$current[0]];
                        break;
                    case $current[0] === 'NOT' && isset($wires[$current[1]]):
                        $wires[$current[2]] = (~$wires[$current[1]] + 65536) % 65536;
                        break;
                    case (isset($wires[$current[0]]) || is_numeric($current[0])) && (isset($wires[$current[2]]) || is_numeric($current[2])):
                        $wires[$current[3]] = ($this->run($wires, $current) + 65536) % 65536;
                        break;
                    default:
                        $next[] = $current;
                        break;
                }
            }
            $instructions = $next;
        }
        return $wires;
    }

    private function run(array $wires, array $instruction): int
    {
        switch ($instruction[1]) {
            case 'AND':
                return ($wires[$instruction[0]] ?? $instruction[0]) & ($wires[$instruction[2]] ?? $instructions[2]);
            case 'OR':
                return ($wires[$instruction[0]] ?? $instruction[0]) | ($wires[$instruction[2]] ?? $instructions[2]);
            case 'LSHIFT':
                return $wires[$instruction[0]] << $instruction[2];
            case 'RSHIFT':
                return $wires[$instruction[0]] >> $instruction[2];
        }
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            switch (true) {
                case strpos($line, 'NOT ') !== false:
                    return sscanf($line, '%s %s -> %s');
                case preg_match('#^[a-z0-9]+ ->#', $line):
                    return sscanf($line, '%s -> %s');
                default:
                    preg_match('#([a-z0-9]+) (AND|OR|[RL]SHIFT) (\w+) -> (\w+)#', $line, $match);
                    return array_slice($match, 1);
            }
        }, explode(PHP_EOL, trim($input)));
    }
}
