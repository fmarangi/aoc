<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day23 implements Puzzle
{
    public function part1(string $input)
    {
        $instructions = $this->parseInput($input);
        $registries   = array_combine(range('a', 'h'), array_fill(0, 8, 0));
        return $this->runWithRegistries($instructions, $registries);
    }

    public function part2(string $input)
    {
        for ($b = 109300, $h = 0; $b <= 126300; $b += 17) {
            if (!$this->isPrime($b)) $h += 1;
        }
        return $h;
    }

    private function isPrime(int $num): bool
    {
        if (($num > 2 && $num % 2 === 0) || $num === 1) return false;
        for ($i = 3, $root = sqrt($num) + 1; $i < $root; $i += 2) {
            if ($num % $i === 0) return false;
        }
        return true;
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $row) {
            return explode(' ', $row);
        }, explode("\n", trim($input)));
    }

    private function runWithRegistries(array $instructions, array $registries): int
    {
        $value = function (string $what) use (&$registries): int {
            return $registries[$what] ?? $what;
        };

        for ($i = 0, $num = count($instructions), $mul = 0; $i < $num; $i++) {
            list($operation, $which, $qty) = $instructions[$i];
            switch ($operation) {
                case 'set':
                    $registries[$which] = $value($qty);
                    break;
                case 'sub':
                    $registries[$which] -= $value($qty);
                    break;
                case 'mul':
                    $registries[$which] *= $value($qty);
                    $mul++;
                    break;
                case 'jnz':
                    if ($value($which) !== 0) {
                        $i += $value($qty) - 1;
                    }
                    break;
            }
        }

        return $mul;
    }
}
