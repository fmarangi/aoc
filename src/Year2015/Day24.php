<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day24 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getBestArrangement($this->parseInput($input));
    }

    public function part2(string $input)
    {
        return $this->getBestArrangementWithTrunk($this->parseInput($input));
    }

    public function getQuantumEntanglement(array $packages): int
    {
        return array_reduce($packages, function (int $result, int $package): int {
            return $result * $package;
        }, 1);
    }

    public function getBestArrangement(array $packages, int $numGroups = 3): int
    {
        $weight = array_sum($packages) / $numGroups;
        $groups = $this->getGroups($packages, $weight);
        $valid  = $this->isValid($packages, $weight);

        $best  = [];
        foreach ($groups as $group) {
            if (!$valid($group)) continue;

            $qe = $this->getQuantumEntanglement($group);
            if ($best && count($group) > $best[0]) {
                continue;
            }

            $best = [count($group), min($qe, $best[1] ?? $qe)];
        }
        return $best[1] ?? 0;
    }

    public function getBestArrangementWithTrunk(array $packages): int
    {
        $weight = array_sum($packages) / 4;
        $groups = $this->getGroups($packages, $weight);

        $best  = [];
        foreach ($groups as $group) {
            if ($this->getBestArrangement(array_diff($packages, $group)) === 0) {
                continue;
            }

            $qe = $this->getQuantumEntanglement($group);
            if ($best && count($group) > $best[0]) {
                continue;
            }

            $best = [count($group), min($qe, $best[1] ?? $qe)];
        }
        return $best[1] ?? 0;
    }

    private function isValid(array $packages, int $weight): callable
    {
        return function (array $group) use ($packages, $weight): bool {
            foreach ($this->getGroups(array_diff($packages, $group), $weight) as $g) {
                return true;
            }
            return false;
        };
    }

    private function getGroups(array $packages, int $weight): \Iterator
    {
        rsort($packages);

        $open = [];
        $min  = count($packages);
        foreach ($packages as $package) {
            for ($i = 0, $max = count($open); $i < $max; $i++) {
                $group = array_merge($open[$i], [$package]);
                $sum   = array_sum($group);
                switch (true) {
                    case $sum === $weight && count($group) <= $min:
                        $min = min($min, count($group));
                        yield $group;
                        break;
                    case $sum < $weight && count($group) < $min:
                        $open[] = $group;
                        break;
                }
            }
            $open[] = [$package];
        }
    }

    private function parseInput(string $input): array
    {
        return array_map('intval', explode(PHP_EOL, trim($input)));
    }
}
