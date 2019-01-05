<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day13 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getHighestHappiness($input);
    }

    public function part2(string $input)
    {
        $guests       = $this->addGuest($this->parseInput($input), 'Francesco');
        $names        = array_keys($guests);
        $arrangements = $this->getArrangements($names);
        return max(array_map($this->getHappiness($guests), $arrangements));
    }

    public function getHighestHappiness(string $input): int
    {
        $guests       = $this->parseInput($input);
        $arrangements = $this->getArrangements(array_keys($guests));
        return max(array_map($this->getHappiness($guests), $arrangements));
    }

    private function getHappiness(array $guests): callable
    {
        return function (array $arrangement) use ($guests) {
            for ($i = 0, $num = count($guests), $happiness = 0; $i < $num; $i++) {
                $guest = $arrangement[$i];
                $prev  = $arrangement[($i + $num - 1) % $num];
                $next  = $arrangement[($i + $num + 1) % $num];
                $happiness += $guests[$guest][$prev] + $guests[$guest][$next];
            }
            return $happiness;
        };
    }

    private function parseInput(string $input): array
    {
        return array_reduce(explode(PHP_EOL, trim($input)), function (array $guests, string $row): array {
            $data = sscanf(trim($row, '.'), '%s would %s %d happiness units by sitting next to %s');
            $guests[$data[0]][$data[3]] = $data[1] === 'gain' ? $data[2] : -$data[2];
            return $guests;
        }, []);
    }

    private function getArrangements(array $guests): array
    {
        $guest = array_pop($guests);
        return array_reduce($guests, function (array $seats, string $guest): array {
            $new = [];
            for ($j = 0, $num = count($seats); $j < $num; $j++) {
                for ($k = 0, $guests = count($seats[$j]); $k <= $guests; $k++) {
                    $new[] = array_merge(array_slice($seats[$j], 0, $k), [$guest], array_slice($seats[$j], $k));
                }
            }
            return $new;
        }, [[$guest]]);
    }

    private function addGuest(array $guests, string $guest): array
    {
        $names = array_keys($guests);
        foreach ($names as $name) $guests[$name][$guest] = 0;
        $guests[$guest] = array_combine($names, array_fill(0, count($names), 0));
        return $guests;
    }
}
