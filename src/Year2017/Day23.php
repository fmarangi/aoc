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
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $row) {
            return explode(' ', $row);
        }, explode("\n", trim($input)));
    }

    private function runWithRegistries($instructions, &$registries, int $init = 0): int
    {
        $value = function (string $what) use (&$registries): int {
            return is_numeric($what) ? $what : ($registries[$what] ?? 0);
        };

        $mul = 0;
        for ($i = $init, $num = count($instructions); $i < $num; $i++) {
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
