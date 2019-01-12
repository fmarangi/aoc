<?php

namespace Mzentrale\AdventOfCode\Year2018\Day19;

class OpcodeConverter
{
    public function convert(string $input, int $numRegisters = 6): string
    {
        [$ip, $instructions] = $this->parseInput($input);
        $registers = $this->getRegisters($numRegisters);
        $reg = $registers[$ip];

        return implode(PHP_EOL, array_map(function (array $data, int $n) use ($reg, $registers) {
            list($instruction, $a, $b, $c) = $data;
            $c = $registers[$c];
            if ($instruction !== 'seti' && $instruction{2} !== 'i') $a = $registers[$a];
            if ($instruction{3} === 'r') $b = $registers[$b];
            $a = $a === $reg ? $n + 2 : $a;
            $b = $b === $reg ? $n + 2 : $b;

            $line = "{$c} = ";
            switch ($instruction) {
                case 'addr':
                case 'addi':
                    if ($b === $c) [$a, $b] = [$b, $a];
                    $line .= "{$a} + {$b}";
                    break;
                case 'mulr':
                case 'muli':
                    if ($b === $c) [$a, $b] = [$b, $a];
                    $line .= "{$a} * {$b}";
                    break;
                case 'bani':
                    $line .= "{$a} & {$b}";
                    break;
                case 'bori':
                    $line .= "{$a} | {$b}";
                    break;
                case 'seti':
                case 'setr':
                    $line .= "{$a}";
                    break;
                case 'eqrr':
                case 'eqri':
                case 'eqir':
                    $line .= "int({$a} == {$b})";
                    break;
                case 'gtrr':
                case 'gtri':
                case 'gtir':
                    $line .= "int({$a} > {$b})";
                    break;
            }
            return preg_replace('#(\w) = \1 (.)#', '$1 $2=', $line);
        }, $instructions, array_keys($instructions)));
    }

    private function getRegisters(int $numRegisters): array
    {
        return range(dechex(10), dechex(10 + $numRegisters - 1));
    }

    private function parseInput(string $input): array
    {
        $lines = explode(PHP_EOL, trim($input));
        $instructions = array_map(function (string $line): array {
            return sscanf($line, '%s %d %d %d');
        }, array_slice($lines, 1));
        return [(int) $lines[0]{4}, $instructions];
    }
}
