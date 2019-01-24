<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day19 implements Puzzle
{
    public function part1(string $input)
    {
        return count($this->getDistinctMolecules(...$this->parseInput($input)));
    }

    public function part2(string $input)
    {
        return $this->generate(...$this->parseInput($input));
    }

    public function getDistinctMolecules(array $rules, string $initial): array
    {
        $molecules = [];
        foreach ($rules as list($from, $to)) {
            $offset = 0;
            while (($offset = strpos($initial, $from, $offset)) !== false) {
                $molecules[] = substr($initial, 0, $offset) . $to . substr($initial, $offset + strlen($from));
                $offset += strlen($from);
            }
        }
        return array_unique($molecules);
    }

    public function generate(array $rules, string $molecule): int
    {
        // Remove molecules containing Rn first
        usort($rules, function (array $a, array $b) {
            return strpos($b[1], 'Rn') <=> strpos($a[1], 'Rn');
        });

        $steps = 0;
        while ($molecule !== 'e') {
            foreach ($rules as list($to, $from)) {
                if (($found = strpos($molecule, $from)) !== false) {
                    $molecule = substr($molecule, 0, $found) . $to . substr($molecule, $found + strlen($from));
                    $steps += 1;
                    break;
                }
            }
        }
        return $steps;
    }

    private function parseInput(string $input): array
    {
        [$rules, $initial] = explode(PHP_EOL . PHP_EOL, trim($input));
        return [array_map(function (string $line): array {
            return explode(' => ', $line);
        }, explode(PHP_EOL, $rules)), $initial];
    }
}
