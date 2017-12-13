<?php

namespace Mzentrale\AdventOfCode;

class Day8 implements Puzzle
{
    private $linePattern = '#^([a-z]+) (inc|dec) (-?[0-9]+) if ([a-z]+) ((?:[<>!=])=?) (-?[0-9]+)$#';

    public function solve($input)
    {
        $lines     = array_map([$this, 'parseLine'], explode(PHP_EOL, trim($input)));
        $registers = array_reduce(array_unique(array_column($lines, 0)), function ($result, $i) {
            return array_merge($result, [$i => 0]);
        }, []);

        foreach ($lines as $line) {
            if ($line[2]($registers)) {
                $registers[$line[0]] = $line[1]($registers[$line[0]]);
            }
        }

        return max($registers);
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
                    return eval("return {$registers[$ref]} $condition $conditionQty;");
                }
            ];
        }
        return [];
    }
}
