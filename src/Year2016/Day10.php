<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day10 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getResponsible(61, 17, $input);
    }

    public function part2(string $input)
    {
        return $this->getOutputProduct([0, 1, 2], $input);
    }

    public function getResponsible(int $a, int $b, string $input): int
    {
        $instructions = $this->parseInput($input);

        [$cmpL, $cmpH] = [min($a, $b), max($a, $b)];

        $bots   = $this->getBots($instructions['value']);
        $output = [];
        while (true) {
            foreach ($instructions['give'] as list($bot, $lowTo, $low, $highTo, $high)) {
                if (count($bots[$bot] ?? []) === 2) {
                    [$l, $h] = [min($bots[$bot]), max($bots[$bot])];
                    $bots[$bot] = [];
                    if ($l === $cmpL && $h === $cmpH) return $bot;
                    $lowTo === 'output' ? $output[$low] = $l : $bots[$low][] = $l;
                    $highTo === 'output' ? $output[$high] = $h : $bots[$high][] = $h;
                    break;
                }
            }
        }
        return 0;
    }

    public function getOutputProduct(array $target, string $input): int
    {
        $instructions = $this->parseInput($input);

        $bots   = $this->getBots($instructions['value']);
        $output = [];
        while (array_intersect($target, array_keys($output)) !== $target) {
            foreach ($instructions['give'] as list($bot, $lowTo, $low, $highTo, $high)) {
                if (count($bots[$bot] ?? []) === 2) {
                    [$l, $h] = [min($bots[$bot]), max($bots[$bot])];
                    $bots[$bot] = [];
                    $lowTo === 'output' ? $output[$low] = $l : $bots[$low][] = $l;
                    $highTo === 'output' ? $output[$high] = $h : $bots[$high][] = $h;
                    break;
                }
            }
        }
        return array_reduce($target, function (int $result, int $key) use ($output) {
            return $output[$key] * $result;
        }, 1);
    }

    private function getBots(array $instructions): array
    {
        return array_reduce($instructions, function (array $bots, array $row): array {
            $bots[$row[2]][] = $row[1];
            return $bots;
        }, []);
    }

    private function parseInput(string $input): array
    {
        $instructions = array_map(function (string $line): array {
            $fmt = [
                'bot %d gives low to %s %d and high to %s %d',
                '%s %d goes to bot %d',
            ];
            $data = sscanf($line, $fmt[0]);
            return array_filter($data) ? $data : sscanf($line, $fmt[1]);
        }, explode(PHP_EOL, trim($input)));

        return array_reduce($instructions, function (array $result, array $row): array {
            $result[$row[0] === 'value' ? 'value' : 'give'][] = $row;
            return $result;
        }, []);
    }
}
