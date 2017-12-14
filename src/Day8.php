<?php

namespace Mzentrale\AdventOfCode;

class Day8 implements Puzzle
{
    private $linePattern = '#^([a-z]+) (inc|dec) (-?[0-9]+) if ([a-z]+) ((?:[<>!=])=?) (-?[0-9]+)$#';

    public function part1(string $input)
    {
        return $this->findMaxAfter($input);
    }

    public function part2(string $input)
    {
        return $this->findMaxDuring($input);
    }

    public function findMaxAfter(string $input)
    {
        $registers = [];
        foreach ($this->getLines($input) as $line) {
            if ($line[2]($registers)) {
                $registers[$line[0]] = $line[1]($registers[$line[0]] ?? 0);
            }
        }
        return max($registers);
    }

    public function findMaxDuring(string $input)
    {
        $max       = 0;
        $registers = [];
        foreach ($this->getLines($input) as $line) {
            if ($line[2]($registers)) {
                $registers[$line[0]] = $line[1]($registers[$line[0]] ?? 0);

                $max = max([$max, max($registers)]);
            }
        }
        return $max;
    }

    public function parseLine(string $line): array
    {
        if (preg_match($this->linePattern, trim($line), $matches)) {
            list(, $target, $operation, $qty, $ref, $condition, $conditionQty) = $matches;

            return [
                $target,
                function ($register) use ($operation, $qty) {
                    return $operation === 'inc' ? $register + $qty : $register - $qty;
                },
                function ($registers) use ($ref, $condition, $conditionQty) {
                    $left = $registers[$ref] ?? 0;
                    return eval("return {$left} $condition $conditionQty;");
                }
            ];
        }
        return [];
    }

    private function getLines($input): array
    {
        return array_map([$this, 'parseLine'], explode(PHP_EOL, trim($input)));
    }
}
