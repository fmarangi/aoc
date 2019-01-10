<?php

namespace Mzentrale\AdventOfCode\Year2018\Day16;

class Opcodes
{
    private $map = [
        0  => 'muli',
        1  => 'seti',
        2  => 'bani',
        3  => 'gtri',
        4  => 'gtrr',
        5  => 'eqrr',
        6  => 'addi',
        7  => 'gtir',
        8  => 'eqir',
        9  => 'mulr',
        10 => 'addr',
        11 => 'borr',
        12 => 'bori',
        13 => 'eqri',
        14 => 'banr',
        15 => 'setr',
    ];

    public function __invoke(array $instruction, array $registers): array
    {
        $func = $this->all()[$this->map[$instruction[0]]];
        return $func($instruction, $registers);
    }

    public function all(): array
    {
        return [
            'addr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] + $registers[$b];
                return $registers;
            },

            'addi' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] + $b;
                return $registers;
            },

            'mulr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] * $registers[$b];
                return $registers;
            },

            'muli' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] * $b;
                return $registers;
            },

            'banr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] & $registers[$b];
                return $registers;
            },

            'bani' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] & $b;
                return $registers;
            },

            'borr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] | $registers[$b];
                return $registers;
            },

            'bori' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] | $b;
                return $registers;
            },

            'setr' => function (array $instruction, array $registers): array {
                list(, $a,, $c) = $instruction;
                $registers[$c] = $registers[$a];
                return $registers;
            },

            'seti' => function (array $instruction, array $registers): array {
                list(, $a,, $c) = $instruction;
                $registers[$c] = $a;
                return $registers;
            },

            'gtir' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $a > $registers[$b] ? 1 : 0;
                return $registers;
            },

            'gtri' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] > $b ? 1 : 0;
                return $registers;
            },

            'gtrr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] > $registers[$b] ? 1 : 0;
                return $registers;
            },

            'eqir' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $a === $registers[$b] ? 1 : 0;
                return $registers;
            },

            'eqri' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] === $b ? 1 : 0;
                return $registers;
            },

            'eqrr' => function (array $instruction, array $registers): array {
                list(, $a, $b, $c) = $instruction;
                $registers[$c] = $registers[$a] === $registers[$b] ? 1 : 0;
                return $registers;
            },
        ];
    }
}
