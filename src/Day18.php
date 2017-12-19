<?php

namespace Mzentrale\AdventOfCode;

class Day18 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getRecoveredFrequency($input);
    }

    public function part2(string $input)
    {
        // TODO: Implement part2() method.
    }

    public function getRecoveredFrequency(string $input): int
    {
        $lastSound    = 0;
        $registries   = [];
        $instructions = $this->parseInput($input);

        for ($i = 0, $num = count($instructions); $i < $num; $i++) {
            switch ($instructions[$i][0]) {
                case 'set':
                case 'add':
                case 'mul':
                case 'mod':
                    $registries = $this->exec($registries, $instructions[$i]);
                    break;
                case 'snd':
                    $lastSound = $this->getValue($registries, $instructions[$i][1]);
                    break;
                case 'rcv':
                    if ($this->getValue($registries, $instructions[$i][1]) > 0) {
                        break 2;
                    }
                    break;
                case 'jgz':
                    if ($this->getValue($registries, $instructions[$i][1]) > 0) {
                        $i += $this->getValue($registries, $instructions[$i][2]) - 1;
                    }
                    break;
            }
        }
        return $lastSound;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return explode(' ', $line);
        }, explode(PHP_EOL, trim($input)));
    }

    private function exec(array $registries, array $instruction): array
    {
        switch ($instruction[0]) {
            case 'set':
                $registries[$instruction[1]] = $this->getValue($registries, $instruction[2]);
                break;
            case 'add':
                $registries[$instruction[1]] = $this->getValue($registries, $instruction[1]) + $this->getValue($registries, $instruction[2]);
                break;
            case 'mul':
                $registries[$instruction[1]] = $this->getValue($registries, $instruction[1]) * $this->getValue($registries, $instruction[2]);
                break;
            case 'mod':
                $registries[$instruction[1]] = $this->getValue($registries, $instruction[1]) % $this->getValue($registries, $instruction[2]);
                break;
        }

        return $registries;
    }

    private function getValue(array $registries, string $value): int
    {
        return is_numeric($value) ? $value : $registries[$value] ?? 0;
    }
}
